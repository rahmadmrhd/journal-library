<form id="manuscript-form" method="POST" class="card grid grid-cols-12 gap-x-6">
  @csrf
  @method('PUT')
  <x-text-input class="col-span-12 xl:col-span-12" type="textarea" rows="2" label="Title" id="title" name="title"
    required autofocus :status="$errors->has('title') ? 'error' : ''" :messages="$errors->get('title')" />

  <x-text-input class="col-span-12 xl:col-span-4" type="select" label="Please choose a category for your paper"
    id="category" name="category" required autofocus :status="$errors->has('category') ? 'error' : ''" :messages="$errors->get('category')">
    <option value="Research paper" selected disabled>Select...</option>
    <option value="Research paper">Research paper</option>
    <option value="Viewpoint">Viewpoint</option>
    <option value="Technical paper">Technical paper</option>
    <option value="Conceptual paper">Conceptual paper</option>
    <option value="Case study">Case study</option>
    <option value="Literature review">Literature review</option>
    <option value="General review">General review</option>
  </x-text-input>

  <x-text-input class="col-span-12" type="textarea" rows="5" label="Abstract" id="abstract" name="abstract"
    required autofocus :status="$errors->has('abstract') ? 'error' : ''" :messages="$errors->get('abstract')" />

  <div class="col-span-12">
    <h2 class="text-lg font-bold mt-4">Plain Language Summary</h2>
    <p>If you would like to have your article made available on Kudos, an online platform (not affiliated with
      ScholarOne) which has been designed to help you increase your article’s impact (more info), please include a plain
      language summary here. To improve the services we make available to you, this summary together with your name and
      email address will be automatically shared with Kudos once your article has been published so that they can invite
      you to register with them and make your summary available on the Kudos platform. Your use of Kudos’ services is
      governed by the Kudos terms and conditions – you can read these <a href="#">here</a>.</p>
  </div>
</form>
</div>
