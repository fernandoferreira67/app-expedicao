<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800"></h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

              <table class="table w-full mt-1 space-y-6 text-sm">
                <thead class="text-blue-800 bg-transparent border border-blue-600">
                  <tr>
                    <th class="p-3 text-center" scope="col">#</th>
                    <th class="p-3 text-center" scope="col">Nome</th>
                    <th class="p-3 text-left" scope="col">Opções</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($collection as $item)
                    <tr class="border-b-[1px] border-blue-100">
                      <td class="py-1 text-center">{{ $item->id }}</td>
                      <td class="py-1 text-center">{{ $item->name }}</td>
                      <td class="py-1 text-center">#</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
        </div>
    </div>
</x-app-layout>
