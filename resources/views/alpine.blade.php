<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALPINE JS -TEST</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-screen">
    <div class="flex items-center justify-center h-full min-h-screen">

        <div class="flex items-center justify-center h-full min-h-screen bg-slate-400">

            <div x-data="{
                names:['Alexandre', 'João', 'Maria'],
                name: '',
                add(){
                    this.names.push(this.name);
                    this.name='';
                },
                remove(name){
                    //Exemple One
                    //this.names.splice(this.names.indexOf(name),1);

                    //Exemple TWO
                    let index = this.names.findIndex(item => item ==name);
                    this.names.splice(index,1);

                }
            }">

            <input type="text" x-model="name" x-on:keydown.enter="add"> <button @click="add">Adicionar</button>


            <ul>
                <template x-for="name in names" x-bind:key="name">
                    <div>
                        <li x-text="name"></li> <button @click="remove(name)">Remover</button>
                    </div>

                </template>
            </ul>

            </div>

</body>
</html>
