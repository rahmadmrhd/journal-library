<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\SubGate;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, SubGate $subGate) {
    if ($request->show && $request->show != 'all' && !is_numeric($request->show)) {
      // return redirect('/admin/mahasiswa');
    }

    $users = User::with('roles')->selectRaw('concat(`users`.`first_name`, " ", `users`.`last_name`) as name, CONCAT_WS(" ", `users`.`title`, `users`.`first_name`, IFNULL(`users`.`last_name`,""), IFNULL(`users`.`degree`,"")) AS `full_name`, `users`.*');
    isset($request->sortBy) ?
      $users->orderBy($request->sortBy, $request->sort ?? 'asc') :
      $users->latest();

    if ($request->search) {
      $users->having('full_name', 'like', '%' . $request->search . '%')
        ->orHaving('username', 'like', '%' . $request->search . '%')
        ->orHaving('email', 'like', '%' . $request->search . '%')
        ->orHaving('preferred_name', 'like', '%' . $request->search . '%');
    }

    $roles = Role::where('slug', '!=', 'admin')
      ->where('slug', '!=', 'author')
      ->get()->map(function ($role) {
        return [
          'value' => $role->id,
          'label' => $role->name
        ];
      });
    return view('pages.users.index', [
      'subGate' => $subGate,
      'users' => $users->paginate($request->show == 'all' ?
        $users->count()  : ($request->show ?? 10)),
      'roles' => $roles
    ]);
  }

  public function find(Request $request, SubGate $subGate, $role, $find) {
    $users = User::with(['roles'])->selectRaw('concat(`users`.`first_name`, " ", `users`.`last_name`) as name, CONCAT_WS(" ", `users`.`title`, `users`.`first_name`, IFNULL(`users`.`last_name`,""), IFNULL(`users`.`degree`,"")) AS `full_name`, `users`.*');
    // find users

    $users->whereRelation('roles', function (Builder $query) use ($role, $subGate) {
      $query->where('slug', $role);
      $query->whereRaw('`role_user`.`sub_gate_id` = ?', [$subGate->id]);
    });
    $users->whereNotIn('id', $request->without ?? []);

    if ($find == 'recomended' && $role != 'author') {
      return response()->json($users->limit(5)->get());
    }

    $users->having('full_name', 'like', '%' . $find . '%')
      ->orHaving('username', 'like', '%' . $find . '%')
      ->orHaving('email', 'like', '%' . $find . '%')
      ->orHaving('preferred_name', 'like', '%' . $find . '%');

    return response()->json($users->limit(5)->get());
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request, SubGate $subGate) {
    $validatedData = $request->validated();
    $validatedData['password'] = Hash::make($request->password);
    $validatedData['email_verified_at'] = new DateTime();

    $user = User::create($validatedData);
    $user->roles()->attach([...$validatedData['roles'], 1]);

    return redirect(route('users.index', $subGate, absolute: false))->with('message', ['status' => 'success', 'msg' => 'User has been created!']);
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user, SubGate $subGate) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SubGate $subGate, User $user) {
    $user->roles = $user->roles->pluck('id');
    return response()->json([
      'data' => $user
    ]);
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, SubGate $subGate, User $user) {
    $validatedData = $request->validated();

    $user->update($validatedData);
    $user->roles()->sync([...$validatedData['roles'], 1]);

    return redirect(route('users.index', $subGate, absolute: false))->with('message', ['status' => 'success', 'msg' => 'User has been updated!']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, SubGate $subGate, User $user) {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user->delete();

    return redirect(route('users.index', $subGate, absolute: false))->with('message', ['status' => 'success', 'msg' => 'User has been deleted!']);
  }
  public function updateStatus(Request $request, SubGate $subGate, User $user) {
    $user->status = $request->status;
    $user->save();
    return response()->json([
      'data' => $user
    ]);
  }
}
