<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Adicionar Nova Transportadora') }}
        </h2>
    </x-slot>
    <div class="flex items-start justify-center min-h-screen p-2 bg-gray-100">
      <div
      x-data="{
        carrier:{
          name: '',
          notes: ''
        },
        errors: [],
        success:'',
        async send(){

          const token = document.querySelector('#__token').getAttribute('content');

          const response = await fetch('/carriers/store', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': token,
              'Content-Type': 'application/json',

            },
            body: JSON.stringify(this.carrier)
          })

          let data = await response.json();

          if(response.ok){
            this.success = data.success;
            return;
          }

          this.errors = data.errors;

        }

      }">
        <div class="container max-w-sm px-6 mx-auto">
          <div class="relative flex flex-wrap">
            <div class="relative w-full">
              <div class="mt-6">
                <form class="mt-8" @submit.prevent="send">
                  <div class="max-w-lg mx-auto">
                    <div class="py-2">
                      <span class="px-1 text-sm text-gray-600">Nome da Transportadora</span>
                      <input placeholder="" name="name" type="text" x-model="carrier.name" class="block w-full px-3 py-2 placeholder-gray-600 bg-white border-2 border-gray-300 rounded-lg shadow-md text-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                      <template x-if="errors.name">
                        <span class="text-white bg-red-800" x-text="errors.name"></span>

                      </template>
                    </div>
                    <div class="py-2">
                      <span class="px-1 text-sm text-gray-600">Anotação</span>
                      <textarea placeholder="" name="notes" cols="30" rows="4" x-model="carrier.notes" class="block w-full px-3 py-2 placeholder-gray-600 bg-white border-2 border-gray-300 rounded-lg shadow-md text-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"></textarea>
                    </div>
                    <button type="submit" class="block w-full px-6 py-3 mt-3 text-lg font-semibold text-white bg-gray-800 rounded-lg shadow-xl hover:text-white hover:bg-black">Salvar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
