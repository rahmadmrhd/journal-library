@props(['fields', 'readonly' => false])

@foreach ($fields as $field)
  @php
    $splitType = explode(':', $field->type);
  @endphp
  @switch($splitType[0])
    @case('checkbox')
    @case('radio')
      <x-text-input :disabled="$readonly" {{ $attributes }} :placeholder="$field->placeholder" type="{{ $splitType[0] }}" :direction="$splitType[1] ?? 'row'"
        :required="$field->required" :id="$field->name" :label="$field->question ?? null" :name="$field->name" :value="old($field->name, $field->answer ?? null)" :messages="$errors->get($field->name)"
        :options="$field->options" />
    @break

    @case('select')
      <x-text-input :disabled="$readonly" {{ $attributes }} :placeholder="$field->placeholder" type="{{ $splitType[0] }}" :id="$field->name"
        :required="$field->required" :label="$field->question ?? null" :name="$field->name" :value="old($field->name, $field->answer ?? null)" :messages="$errors->get($field->name)" :options="$field->options" />
    @break

    @case('editor')
      <x-text-editor :disabled="$readonly" {{ $attributes }} :placeholder="$field->placeholder" :id="$field->name" :name="$field->name"
        :required="$field->required" :label="$field->question" :initValue="$field->answer" :messages="$errors->get($field->name)" />
    @break

    @case('description')
      <x-text-editor :disabled="true" {{ $attributes }} :placeholder="$field->placeholder" :id="$field->name" :name="$field->name"
        :required="$field->required" :label="$field->question" :initValue="$field->placeholder" :messages="$errors->get($field->name)" />
    @break

    @case('divider')
      <div class="mb-2 border-b border-gray-300 pb-2 dark:border-gray-700">
        <h3 class="text-left text-xl font-extrabold lg:text-3xl">
          {{ $field->question }}
        </h3>
        <p class="mt-2 text-sm font-thin italic">
          {{ $field->description }}
        </p>
      </div>
    @break

    @default
      <x-text-input :disabled="$readonly" {{ $attributes }} :placeholder="$field->placeholder" type="{{ $splitType[0] }}" :id="$field->name"
        :required="$field->required" :label="$field->question ?? null" :name="$field->name" :value="old($field->name, $field->answer ?? null)" :messages="$errors->get($field->name)" />
  @endswitch
@endforeach
