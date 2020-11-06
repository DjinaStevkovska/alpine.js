<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpine.js</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="/js/tasks-list.js"></script>
</head>
<body>

    <div class="m-5 max-w-lg mx-auto">
        <a href="memory-game">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Go to memory game
            </button>
        </a>
    </div>
    

    <br><hr><br>


    <div x-data="{ message: 'Hellooo' }" class="m-5 max-w-lg mx-auto">
        {{-- <h1 x-text="message.toUpperCase().substr(1)"></h1> --}}
        <h1 x-text="message"></h1>
        <button x-on:click="message = 'Changed'" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            click me
        </button>
        
        <br><br>

        <strong>Message:</strong> 
        <br>
        {{-- <input x-bind:value="message" type="text"> --}}
        {{-- <input :value="message" type="text"> --}}
        <input 
            class="shadow appearance-none border rounded py-2 
            px-3 text-gray-700 leading-tight focus:outline-none 
            focus:shadow-outline" x-model="message" type="text">
    </div>


    <br><hr><br>


    <div x-data="{ first: 0, second: 0 }" class="m-5 max-w-lg mx-auto">
        <input type="text" x-model.number="first"
            class="shadow appearance-none border rounded py-2 
            px-3 text-gray-700 leading-tight focus:outline-none 
            focus:shadow-outline">
        +
        <input type="text" x-model.number="second"
            class="shadow appearance-none border rounded py-2 
            px-3 text-gray-700 leading-tight focus:outline-none 
            focus:shadow-outline">
        =
        <output x-text="first + second"></output>
    </div>


    <br><hr><br>


    <div x-data="{ show: false }" class="m-5 max-w-lg mx-auto">
        <h1 x-show="show">Lorem ipsum dolor sit.</h1>

        <button 
            x-on:click="show = !show"
            x-text="show ? 'Hide' : 'Show'"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Click me
        </button>

        <div x-show="show">
            <a href="" style="display: block">hi</a>
            <a href="" style="display: block">hi</a>
            <a href="" style="display: block">hi</a>
            <a href="" style="display: block">hi</a>
        </div>
    </div>


    <br><hr><br>


    <style>
        .active { background-color:darkgoldenrod; }
    </style>

    <div x-data="{ currentTab: '' }" class="max-w-lg mx-auto">
        <button x-on:click="currentTab = 'first'" :class="{ 'active' : currentTab === 'first'}"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">First</button>
        <button x-on:click="currentTab = 'second'" :class="{ 'active' : currentTab === 'second'}"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Second</button>
        <button x-on:click="currentTab = 'third'" :class="{ 'active' : currentTab === 'third'}"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Third</button>


        <div style="border: 1px dotted grey; padding: 1em; margin-top: 20px;">
            <div x-show="currentTab === 'first'">
                <p>First</p>
            </div>
    
            <div x-show="currentTab === 'second'">
                <p>Second</p>
            </div>
    
            <div x-show="currentTab === 'third'">
                <p>Third</p>
            </div>
        </div>
    </div>


    <br><hr><br>


    {{-- TWO WAY DATA BINDING --}}
    <div class="p-10 max-w-lg mx-auto">
        <form x-data="{ 
            form: {
                name: 'John Doe',
                age: '',
                email: '',
                bio: ''
            },

            user: null,

            submit() {
                fetch('https://reqres.in/api/users', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json'},
                    body: JSON.stringify(this.form)
                })
                .then(response => response.json())
                .then(user => this.user = user);
                {{-- .then(console.log); --}}
                {{-- alert('blablalbalbl');
                console.log(this.form); --}}
            }
        }"
         
         {{-- x-on:submit.prevent="alert('hi')" --}}
         x-on:submit.prevent="submit"
        >
            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    for="name">Name</label>
                <input 
                    class="border border-gray-400 p-2 w-full" 
                    type="text" 
                    name="name" 
                    id="name" 
                    x-model="form.name"     
                    {{-- :value="name"
                    x-on:input="name = $event.target.value"    // same as x-model  --}}
                    required>

                    <p class="text-xs" x-text="form.name"></p>
            </div>

            <template x-if="user">
                <div x-text="'The user ' + user.name + ' was created at ' + user.createdAt"></div>
            </template>
        </form>
    </div>


    <br><hr><br>


    <div class="bg-gray-300 p-10 rounded max-w-lg mx-auto"
          x-data="taskApp()">
        <form x-on:submit.prevent="submitTask">
            <input x-model="newTask" 
                  type="text"
                  class="w-full mx-auto p-1"
                  placeholder="Write tasks here...">
        </form>

        <ul class="list-disc m-3">
            <template x-for="(task, index) in tasks" :key="index">
                <li>
                    <input type="checkbox" x-model="task.completed">
                    <span x-text="task.body" :class="{ 'line-through' : task.completed }"></span>
                </li>
            </template>
            
        </ul>
    </div>

    {{-- included as tasks-list.js 
        <script>
        let taskApp = () => {
            return { 
                tasks: [], 
                newTask: '',

                submitTask() {
                    this.tasks.push({ body: this.newTask, completed: false}); 
                    this.newTask = '';
                }  
            };
        }     
    </script> --}}


    <br><hr><br>

    
    {{-- FLASH COMPONENT --}}
    <div>
        <div x-data>
            {{-- <button x-on:click="flashCustom('hello there')">custom flash</button> --}}
            <button x-on:click="$dispatch('flashCustom', 'blablal')">disptach cudtom flash</button>
        </div>
    </div>
    

    <br><hr><br>


    <div 
        x-data="{ show: false, message = '' }"
        x-show.transition.opacity.scale.75.duration.3000="show"
        x-on:flashCustom.window="
            show = true;    
            message = $event.detail;
            
            setTimeout(() => show = false, 3000)
            "
        x-text="message"
        class="fixed bottom-0 right-0 mb-4 mr-4 bg-blue-500 text-white p-4 rounded"
        >

    </div>

    <script>
        window.flash = message => window.dispatchEvent(new CustomEvent('flashCustom', { detail: message }));
    </script>
    {{-- <div x-data class="p-10 max-w-lg mx-auto mb-4">
        <button x-on:click="alert('hi')">Click Me</button>
    </div> --}}

</body>
</html>