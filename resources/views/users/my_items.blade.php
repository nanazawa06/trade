<x-header >
  @include('layouts.navigation')
  <div x-data="mygoods" class="mx-auto mt-9 p-8 border border-gray-400 rounded-3xl max-w-md bg-slate-50">
    <h3 class="text-xl font-medium font-mono border-b-2">譲りたいものリスト</h3>
    <div class="mt-3  rounded-md">
      <input type="text" x-model="newItem" @keydown.enter="updateMygoods('POST', newItem)" class="border rounded-md border-slate-400 py-1">
      <button @click="updateMygoods('POST', newItem)" type="button" class="ml-4 inline-flex items-center justify-center py-2 px-4 text-sm font-bold tracking-wide text-white rounded shadow-md bg-blue-500 hover:bg-blue-700">追加</button>
    </div>
    <div class="divide-y divide-gray-300/50">
      <div class="space-y-6 pt-3 text-base leading-7 text-gray-600">
        <ul class="space-y-4">
          <template x-for="item in itemList">
            <li class="flex items-center">
              <svg @click="updateMygoods('DELETE', item.name)" class="h-7 w-7 text-slate-400 hover:text-slate-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="15" y1="9" x2="9" y2="15" />  <line x1="9" y1="9" x2="15" y2="15" /></svg>
              <p x-text="item.name" class="ml-4 "></p>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </div>
</x-header>