<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Carriers') }}
        </h2>
    </x-slot>


    <div class="flex items-start justify-center min-h-screen p-2 bg-gray-100">

      <div class="container max-w-screen-lg mx-auto">

        <div x-data="{
            itens:{
              user:'{{$data->user_id}}',
              packages: '{{$data->id}}',
              danfe:[]
            },
            number:'',
            count:0,
            add(){


                if(!(this.number.length === 44 || this.number.length === 11)){
                    console.log('Caracteres Inválida!');
                    alert('Quantidade de Caracteres Inválida!');
                    this.number='';
                    return;
                }

                if(this.number === ''){
                    console.log('Chave de Acesso em Branco!');
                    alert('Chave de Acesso em Branco!');
                    this.number='';
                    return;
                }

                if (this.itens.danfe.includes(this.number)) {
                    console.log('Chave NFE Inválida ou Já Adicionado.');
                    alert('Chave NFE Já Adicionada a esse romaneio.');
                    this.number='';
                  } else {
                    const token = document.querySelector('#__token').getAttribute('content');

                    const response = fetch('/logistics/packages/readAccessKey', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ access_key: this.number })
                    })

                    .then((response) => response.json())
                    .then(data => {
                        if(data.success == 'ok'){
                            this.itens.danfe.push(this.number);
                            this.count++;
                            this.number='';
                        }else{
                            alert(data.message);
                            this.number='';
                        }

                    })
                  }

            },
            remove(number){
              let index = this.itens.danfe.findIndex(item => item == number);
              this.itens.danfe.splice(index,1);
              this.count--;
            },
            async enviarArray(){

              const token = document.querySelector('#__token').getAttribute('content');

              const response = await fetch('/logistics/packages/store', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': token,
                  'Content-Type': 'application/json',

                },
                body: JSON.stringify(this.itens, this.user)
              }).then((response) => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.href='{{route("logistics")}}';
              })


              }

        }">

        <div class="flex justify-around">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                </svg>
                <h4 class="text-md/[17px] text-sm/[12px] font-bold">{{$data->id}}</h4>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                  </svg>
                <h4 class="text-md/[17px] text-sm/[12px] font-bold ml-1">{{$data->created_at->format('d/m/Y')}}</h4>
            </div>
            <div class="flex items-center">
                <h4 class="text-md/[17px] text-sm/[12px] font-bold bg-green-200 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300 me-2 p-3">{{$data->status}}</h4>
            </div>

        </div>
        <div class="flex justify-center my-2">
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
                <div>
                 <span class="hidden lg:block">Transportadora:</span>
                </div>
                <h4 class="ml-1 text-md/[17px] font-bold">{{$data->carrier->name}}</h4>
            </div>
            <div class="flex items-center justify-center ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <span x-text="count" class="ml-1 font-bold"></span>
            </div>
        </div>

        <form action="" @submit.prevent="enviarArray" class="flex justify-around">
            <button type="submit" class="px-5 py-3 text-sm font-medium text-white bg-green-700 rounded-lg focus:outline-none hover:bg-green-800 focus:ring-4 focus:ring-green-300 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"> Finalizar Romaneio </button>
        </form>

            <div class="flex justify-around">
                <div class="my-6 ">
                    <label class="block mb-2 text-sm font-medium">Chave de Acesso (NFE)</label>
                    <div class="flex content-center justify-center">

                    <input type="text" x-model="number" x-on:keydown.enter="add" name="chave_nfe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    <button type="button" @click="add" class="px-5 py-4 text-sm font-medium text-white bg-green-700 rounded-lg focus:outline-none hover:bg-green-800 focus:ring-4 focus:ring-green-300 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Adicionar</button>
                    </div>

                    <ul class="mt-4">
                      <template x-for="(number, index) in itens.danfe" x-bind:key="number" class="m-0">
                          <div class="flex flex-row justify-between items-center border-b-[1px] border-gray-400">
                              <li x-text="number" class="text-xs basis-9/12 text-md text-wrap w-75"></li>
                              <button class="p-1 text-white bg-red-400" @click="remove(number)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>
                              </button>
                          </div>
                      </template>
                    </ul>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>
