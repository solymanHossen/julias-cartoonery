<?php
/**
 * Template Name: Playground (Games)
 */
get_header(); 
?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="text-center mb-10">
        <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-500 dark:text-purple-400"><line x1="6" x2="10" y1="12" y2="12"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="15" x2="15.01" y1="13" y2="13"/><line x1="18" x2="18.01" y1="11" y2="11"/><rect width="20" height="12" x="2" y="6" rx="2"/></svg>
        </div>
        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mb-4">Playground</h1>
        <p class="text-gray-500 dark:text-gray-400">Match the pairs to win! A fun memory game for kids.</p>
    </div>

    <div class="max-w-2xl mx-auto bg-white dark:bg-slate-800 rounded-[40px] p-8 shadow-xl border border-gray-100 dark:border-slate-700">
        <div class="flex justify-between items-center mb-8">
            <span class="font-bold text-gray-600 dark:text-gray-300">Moves: <span id="game-moves" class="text-[#A8D8EA] dark:text-sky-400 text-xl">0</span></span>
            <button id="btn-restart" class="border-2 border-[#FFB7C5] text-pink-500 hover:bg-pink-50 dark:border-pink-500 dark:text-pink-400 dark:hover:bg-slate-700 px-6 py-2 rounded-full font-bold transition-all">Restart Game</button>
        </div>

        <div id="win-screen" class="hidden text-center py-20 animate-in zoom-in">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400 mx-auto mb-6 animate-bounce"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
            <h2 class="font-['Bubblegum_Sans'] text-4xl text-[#FFB7C5] dark:text-pink-400 mb-4">You Won!</h2>
            <p class="text-gray-500 dark:text-gray-300 mb-8">Great job matching all the cards!</p>
        </div>

        <div id="game-board" class="grid grid-cols-3 sm:grid-cols-4 gap-4 perspective-1000">
            </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const CHARACTERS = [
            "https://images.unsplash.com/photo-1559454403-b8fb88521f11?w=400",
            "https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=400",
            "https://images.unsplash.com/photo-1598439210625-5067c578f3f6?w=400",
            "https://images.unsplash.com/photo-1618843422409-90bc892695dd?w=400",
            "https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?w=400",
            "https://images.unsplash.com/photo-1590422749893-6c8f61536b28?w=400"
        ];
        
        let cards = [], flippedIndices = [], matchedIds = [], moves = 0;
        const board = document.getElementById('game-board');
        const movesEl = document.getElementById('game-moves');
        const winScreen = document.getElementById('win-screen');

        function startNewGame() {
            let gameItems = CHARACTERS.map((img, i) => ({ id: `img-${i}`, img }));
            let shuffled = [...gameItems, ...gameItems].sort(() => Math.random() - 0.5).map((item, idx) => ({ ...item, uniqueId: idx }));
            cards = shuffled; flippedIndices = []; matchedIds = []; moves = 0;
            movesEl.innerText = moves;
            winScreen.classList.add('hidden');
            board.classList.remove('hidden');
            renderBoard();
        }

        function handleCardClick(idx) {
            if (flippedIndices.length === 2 || flippedIndices.includes(idx) || matchedIds.includes(cards[idx].id)) return;
            flippedIndices.push(idx);
            renderBoard();
            if (flippedIndices.length === 2) {
                moves++; movesEl.innerText = moves;
                if (cards[flippedIndices[0]].id === cards[flippedIndices[1]].id) {
                    matchedIds.push(cards[flippedIndices[0]].id);
                    flippedIndices = [];
                    if (matchedIds.length === cards.length / 2) {
                        setTimeout(() => { board.classList.add('hidden'); winScreen.classList.remove('hidden'); }, 500);
                    }
                } else {
                    setTimeout(() => { flippedIndices = []; renderBoard(); }, 1000);
                }
            }
        }

        function renderBoard() {
            board.innerHTML = '';
            cards.forEach((card, idx) => {
                const isFlipped = flippedIndices.includes(idx) || matchedIds.includes(card.id);
                const el = document.createElement('div');
                el.className = `relative aspect-square cursor-pointer transform-style-3d transition-transform duration-500 ${isFlipped ? '[transform:rotateY(180deg)]' : ''}`;
                el.innerHTML = `
                    <div class="absolute inset-0 bg-gradient-to-br from-[#FFB7C5] to-[#A8D8EA] dark:from-pink-600 dark:to-sky-600 rounded-2xl flex items-center justify-center shadow-sm backface-hidden ${isFlipped ? 'hidden' : ''}">
                        <span class="font-['Bubblegum_Sans'] text-white text-3xl opacity-50">?</span>
                    </div>
                    <div class="absolute inset-0 bg-gray-50 dark:bg-slate-700 rounded-2xl overflow-hidden shadow-sm backface-hidden [transform:rotateY(180deg)] ${!isFlipped ? 'hidden' : ''}">
                        <img src="${card.img}" class="w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal" />
                    </div>
                `;
                el.onclick = () => handleCardClick(idx);
                board.appendChild(el);
            });
        }

        document.getElementById('btn-restart').onclick = startNewGame;
        startNewGame();
    });
</script>

<?php get_footer(); ?>
