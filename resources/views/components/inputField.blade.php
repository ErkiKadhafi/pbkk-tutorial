<div class="flex w-full">
    <div class="mb-3 w-full">
        <label for={{ $idInput }} class="form-label inline-block mb-2 text-gray-700">{{ $label }} <span class="text-red-500 {{ isset($required) ? '' : 'hidden' }}">*</span></label>
        <input type={{ $type }}
            class="
          form-control
          block
          w-full
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding
          border border-solid border-gray-300
          rounded-md
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-500 focus:outline-none
        "
            id={{ $idInput }} placeholder={{ isset($placeholder) ? $placeholder : '' }} name={{ $name }}
            {{ isset($required) ? 'required' : '' }} />
    </div>
</div>
