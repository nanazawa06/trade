<x-header>
    <div class="top-preview w-200 relative"></div>
    <div class="preview-box flex flex-wrap gap-1 m-2"></div> 
    <form class="py-6 px-9" action="/posts" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="mb-6 pt-4">
            <label class="mb-5 block text-xl font-semibold text-[#07074D]">
              Upload File
            </label>
            <!-- 画像のアップロード -->
            <div class="mb-8">
              　<input type="file" name="images[]" id="input" accept="image/*" multiple class="sr-only" />
              　<label
                for="input" class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                <div>
                      <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                        Drop files here
                      </span>
                      <span class="mb-2 block text-base font-medium text-[#6B7280]">
                        Or
                      </span>
                      <span
                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]"
                      >
                        Browse
                      </span>
                </div>
                </label>
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