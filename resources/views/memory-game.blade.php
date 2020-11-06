<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
    {{-- <div x-data="{message: 'Click Me'}">
        <div class="h-32 bg-gray-300">
            <button @click="message = 'I have been clicked'" x-text="message"></button>
        </div>
    </div> --}}


    <div x-data="game()"
        class="px-10 flex items-center justify-center min-h-screen">
        <h1 class="fixed top-0 right-0 p-10 font-bold text-3xl">
            <span x-text="points"></span>
            <span class="text-xs">pts</span>
        </h1>

        <div class="flex-1 grid grid-cols-4 gap-10">
            <template x-for="card in cards">
                <div>
                    <button  x-show="! card.cleared"
                            :style="'background: ' + (card.flipped ? card.color : '#999')" 
                            @click="flipCard(card)"
                            class="w-full h-32 cursor-pointer" 
                        >

                    </button>
                </div>



            </template>
        </div>
    </div>

    <div x-data="{ show: false }"
        x-show.transition.opacity="show"
        x-text="message"
        x-on:flash.window="
            message = $event.detail.message; 
            show=true;
            setTimeout(() => show = false, 1000)
            "
        class="fixed bottom-0 right-0 bg-blue-500 text-white p-2 mb-4 mr-4 rounded"
    >
        
    {{-- <span x-text="message" class="pr-4"></span>
    <button x-on:click="show=false">&times;</button> --}}

    </div>

    <script>
        function pause(milliseconds = 1000) {
            return new Promise(resolve => setTimeout(resolve, milliseconds));

            // return new Promise(function (resolve) {
            //     return setTimeout(resolve, milliseconds);
            // });
        }

        function flash(message) {
            window.dispatchEvent(new CustomEvent('flash', {
                detail: { message }
            }));
        }

        function game() {
            return { 
                cards: [
                    { color: 'green', flipped: false, cleared: false},
                    { color: 'red', flipped: false, cleared: false},
                    { color: 'blue', flipped: false, cleared: false},
                    { color: 'yellow', flipped: false, cleared: false},
                    { color: 'green', flipped: false, cleared: false},
                    { color: 'red', flipped: false, cleared: false},
                    { color: 'blue', flipped: false, cleared: false},
                    { color: 'yellow', flipped: false, cleared: false}
                ],
                

                get flippedCards () {
                    return this.cards.filter(card => card.flipped);
                },

                
                get clearedCards () {
                    return this.cards.filter(card => card.cleared);
                },


                get remainingCards () {
                    return this.cards.filter(card => !card.cleared);
                    // this.clearedCards.length === this.cards.length
                },

                
                get points() {
                    return this.clearedCards.length;
                },


                async flipCard(card) {
                    if (this.flippedCards.length === 2) {
                        return;
                    }

                    card.flipped = ! card.flipped

                    if (this.flippedCards.length === 2) {
                        // alert('check for march');
                        if (this.hasMatch()) {
                            flash('You found a match!')
                            // alert('You have a match');

                            await pause(); 
                            // setTimeout(() => {
                                this.flippedCards.forEach(card => card.cleared = true);
                            // }, 500);


                            // check if there are no remaining cards
                            if (!this.remainingCards.length) {
                                alert('you won');
                            }

                        } else {
                            flash('Not a match!');
                        }
                

                        setTimeout(() => {
                            // flipback if no match
                            this.flippedCards.forEach(card => card.flipped = false)    
                        }, 500);

                    }
                },


                hasMatch() {
                    return this.flippedCards[0]['color'] === this.flippedCards[1]['color'];
                },


            };
        }
    </script>


</body>
</html>