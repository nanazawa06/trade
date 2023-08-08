<x-header>
    <div class="top-preview w-200 h-200 relative mx-5 mt-5"></div>
    <form class="py-6 px-9" action="/posts" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="mb-6 pt-4">
            <label class="mb-5 block text-xl font-semibold text-[#07074D]">
              Upload File
            </label>
            <!-- 画像のアップロード -->
            <div class="grid grid-cols-4 grid-auto-rows: minmax(0, 1fr)">
              <div id="preview0" class="h-50 w-50 hidden"></div>
              <div class="upload-box0 relative grid grid-cols-1 mt-5 mx-2 aspect-square">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                        </div>
                        <input type="file" name="images[0]" id="input" accept="image/*" class="file sr-only" />
                    </label>
                </div>
              </div>
  
              <div id="preview1" class="hidden"></div>
              <div class="upload-box1 relative grid grid-cols-1 mt-5 mx-2 aspect-square">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                        </div>
                        <input type="file" name="images[1]" id="" accept="image/*" class="file sr-only" />
                    </label>
                </div>
              </div>
  
              <div id="preview2" class="hidden"></div>
              <div class="upload-box2 relative grid grid-cols-1 mt-5 mx-2 aspect-square">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                        </div>
                        <input type="file" name="images[2]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
  
              <div id="preview3" class="hidden"></div>
              <div class="upload-box3 relative grid grid-cols-1 mt-5 mx-2 aspect-square">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                        </div>
                        <input type="file" name="images[3]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
            </div>
          
              <div class="flex-auto p-6">
                
                  <div class="flex flex-wrap">
                      <div class="mb-5">
                          <label
                            for="want"
                            class="mb-3 block text-base font-medium text-[#07074D]"
                          >
                            譲りたいもの:
                          </label>
                          <input
                            type=""
                            name="gives[]"
                            placeholder="譲りたいものを記入してください"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                          />
                      </div>
                      <div class="mb-5">
                          <label
                            for="give"
                            class="mb-3 block text-base font-medium text-[#07074D]"
                          >
                            欲しいもの:
                          </label>
                          <input
                            type=""
                            name="wants[]"
                            placeholder="欲しいものを記入してください"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                          />
                      </div>
                  </div>
                  <div class="mb-6">
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
                          ></textarea>
                  </div>
              </div>
        </div>
      </div>
      <div class="bg-white">
          <div class="overflow-x-auto border-x border-t">
              <table class="table-auto w-full">
                  <tbody>
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                            出品者 
                          </td>
                          <td class="p-4">
                            
                          </td>
                      </tr>
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                            状態
                          </td>
                          <td class="p-4">
                            <select name="state_id" class="p-3 rounded border border-gray-300">
                                <option>状態を選択</option>
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
                            
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
      <div class="">
          <input type=submit value="出品する" class="bg-orange-500 border border-gray-300 text-white-900 sm:text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block p-2.5">
      </div>
    </form>
    <script src="/js/app.js"></script>
</x-header>