<x-header>
    <div class="top-preview mx-5 mt-5">
      @if ( $post->images[0])
        <div class="aspect-square max-w-2xl relative bg-gray-100">
            <img src="{{ $post->images[0]->image_url }}" alt="画像が読み込めませんでした" id="big-image" 
              class="absolute object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full" loading="lazy" />
         </div>
      @endif
    </div>
    <form class="py-6 px-9" action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="mb-6 pt-4">
            <label class="mb-3 mx-7 block text-xl font-semibold text-[#07074D]">
              画像をアップロード
            </label>
            <div class="flex-1">
              <div class="grid grid-cols-4 gap-2">
                @for ($i = 0; $i < 4; $i++)
                  @if ($i < $post->images->count())
                    <div id="preview{{ $i }}" class="">
                        <div class="relative h-full w-full mx-auto overflow-hidden bg-glay-100 rounded-5">
                            <img src="{{ $post->images[$i]->image_url }}" class="small-image absolute object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full z-0 bg-slate-100" loading="lazy" />
                            <button type="button" class="delete absolute z-10 top-0 right-0 bg-gray-400 rounded-full">
                                <svg class="h-8 w-8 text-white p-1"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                    <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="upload-box{{ $i }} relative grid grid-cols-1 mx-2 aspect-square hidden">
                      <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                          <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                              <div class='flex flex-col items-center justify-center'>
                                  <svg class="w-4/12 absolute object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                  </svg>
                                  
                              </div>
                              <input type="file" name="images[{{ $i }}]" id="" accept="image/*" class="file sr-only"/>
                          </label>
                      </div>
                    </div>
                  @else
                    <div id="preview{{ $i }}" class="hidden">
                    </div>
                    <div class="upload-box{{ $i }} relative grid grid-cols-1 mx-2 aspect-square">
                      <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                          <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                              <div class='flex flex-col items-center justify-center pt-7'>
                                  <svg class="w-4/12 absolute object-cover top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                  </svg>
                                  
                              </div>
                              <input type="file" name="images[{{ $i }}]" id="" accept="image/png,image/jpeg,image/gif" class="file sr-only"/>
                          </label>
                      </div>
                    </div>
                  @endif
                @endfor
              </div>
      
          <div class="flex-auto p-6">
            
              <div class="flex flex-wrap gap-4">
                  <div class="mb-5">
                      <label
                        for="want"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                      >
                        譲りたいもの:
                      </label>
                      @foreach ($post->gives as $give)
                        <input
                          type="text"
                          name="gives[]"
                          value="{{ $give->name }}"
                          placeholder="譲りたいもの"
                          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                      @endforeach
                      @error('gives.*')
                        @foreach ($errors->get('gives.*') as $messages)
                          @foreach ($messages as $message)
                            <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                          @endforeach
                        @endforeach
                      @enderror
                  </div>
                  <div class="mb-5">
                      <label
                        for="give"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                      >
                        欲しいもの:
                      </label>
                      @foreach ($post->wants as $want)
                        <input
                          type="text"
                          name="wants[]"
                          value="{{ $want->name }}"
                          placeholder="欲しいもの"
                          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                      @endforeach
                      @error('wants.*')
                        @foreach ($errors->get('wants.*') as $messages)
                          @foreach ($messages as $message)
                            <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                          @endforeach
                        @endforeach
                      @enderror
                  </div>
              </div>
              <div class="">
                  <textarea
                      rows="6"
                      name="description"
                      placeholder="詳細を記入してください"
                      class="
                      w-full
                      rounded
                      py-3
                      px-[14px]
                      text-body-color text-base
                      border border-[f0f0f0]
                      resize-none
                      outline-none
                      focus-visible:shadow-none
                      focus:border-primary
                      "
                      >{{ $post->description }}</textarea>
                  @error('description')
                      <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                          <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <div>
                              {{ $message }}
                          </div>
                      </div>
                  @enderror
              </div>
          </div>
        </div>
      </div>
      <div class="bg-white max-w-4xl text-center mx-6" style="width:300px;">
          <div class="overflow-x-auto border-x border-t">
              <table class="table-auto w-full">
                  <tbody>
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                            出品者 
                          </td>
                          <td class="p-4">
                            {{ $post->user->name }}
                          </td>
                      </tr>
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                            状態
                          </td>
                          <td class="p-4">
                            <select name="state_id" class="p-3 rounded border border-gray-300">
                                <option value="">状態を選択</option>
                                @foreach ($states as $state)
                                    <option class="p-2 block hover:bg-grey-light sursor-pointer" value="{{ $state->id }}">{{ $state->state }}</option>
                                @endforeach
                            </select>
                          </td>
                      </tr>
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                            発送元の地域
                          </td>
                          <td class="p-4">
                            {{ $post->id /*$post->user->area->prefecture*/ }}
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
      @error('state_id')
        <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ $message }}
            </div>
        </div>
      @enderror
      <div class="text-center mt-2">
          <input type=submit value="保存" class=" hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-4 border border-red-500 rounded">
      </div>
    </form>
    <script src="/js/app.js"></script>
</x-header>