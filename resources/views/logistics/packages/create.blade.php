<x-app-layout>
  <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Criando Romaneio') }}
      </h2>
  </x-slot>
  <div class="flex items-start justify-center min-h-screen p-2 bg-gray-100">
      <div class="container max-w-sm px-6 mx-auto">
        <div class="relative flex flex-wrap">
          <div class="relative w-full">
            <div class="mt-6">
              <form class="mt-8" action="{{route('packages.open')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="max-w-lg mx-auto">
                  <div class="py-2">
                    <span class="px-1 text-sm text-gray-600">Selecione a Transportadora</span>
                    <select name="carrier_id" id="" class="block w-full px-3 py-2 placeholder-gray-600 bg-white border-2 border-gray-300 rounded-lg shadow-md text-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                      @foreach ($data as $item)
                        <option value="{{$item->id}}"> {{$item->name}}</option>
                      @endforeach
                    </select>
                    @error('carrier_id')
                      <div class="mt-2 text-xs font-light text-red-800">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="py-2">
                    <span class="px-1 text-sm text-gray-600">Anotação</span>
                    <textarea placeholder="" name="notes" cols="30" rows="4" class="block w-full px-3 py-2 placeholder-gray-600 bg-white border-2 border-gray-300 rounded-lg shadow-md text-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"></textarea>
                  </div>
                  <div class="py-2 ">
                    <span class="px-1 font-light text-black">Usuário Responsável: {{auth()->user()->name}}</span>
                    <input placeholder="" name="user_id" type="hidden" value=" {{auth()->user()->id}}" class="block w-full px-3 py-2 placeholder-gray-600 bg-white border-2 border-gray-300 rounded-lg shadow-md text-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                  </div>
                  <button type="submit" class="block w-full px-6 py-3 mt-3 text-lg font-semibold text-white bg-gray-800 rounded-lg shadow-xl hover:text-white hover:bg-black">Salvar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>
