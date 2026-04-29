<?php
/**
 * Template Name: Create AI Character
 */
get_header(); 
?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-[40px] shadow-xl overflow-hidden border border-gray-100 dark:border-slate-700">
        <div class="bg-gradient-to-r from-[#A8D8EA] to-[#B5EAD7] dark:from-sky-700 dark:to-emerald-700 p-10 text-center relative overflow-hidden">
            <h1 class="font-['Bubblegum_Sans'] text-4xl lg:text-5xl text-white mb-3 relative z-10 drop-shadow-sm">Create Your Character</h1>
            <p class="text-white/90 font-bold relative z-10">Use free AI tools to bring your imagination to life!</p>
        </div>

        <div class="p-8 lg:p-12">
            <div class="mb-8">
                <label class="block text-gray-700 dark:text-gray-300 font-bold mb-3 text-lg">Describe your character</label>
                <textarea id="ai-prompt" placeholder="e.g. A cute fluffy bunny wearing a tiny blue backpack..." class="w-full p-4 rounded-2xl bg-gray-50 dark:bg-slate-900 border-2 border-gray-100 dark:border-slate-700 focus:border-[#A8D8EA] dark:focus:border-sky-500 focus:ring-0 transition-colors outline-none min-h-[120px] resize-y dark:text-white"></textarea>
            </div>

            <div class="mb-10">
                <label class="block text-gray-700 dark:text-gray-300 font-bold mb-3 text-lg">Choose a style</label>
                <div class="flex flex-wrap gap-3" id="style-buttons">
                    <button class="ai-style-btn px-5 py-2 rounded-full font-bold transition-all bg-[#FFB7C5] dark:bg-pink-500 text-white shadow-md transform scale-105" data-style="Cute 3D">Cute 3D</button>
                    <button class="ai-style-btn px-5 py-2 rounded-full font-bold transition-all bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-300 hover:bg-gray-200" data-style="Watercolor">Watercolor</button>
                    <button class="ai-style-btn px-5 py-2 rounded-full font-bold transition-all bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-300 hover:bg-gray-200" data-style="Pixel Art">Pixel Art</button>
                </div>
            </div>

            <div class="h-px bg-gray-100 dark:bg-slate-700 w-full mb-10"></div>

            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Select an AI Engine to Generate</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button id="generate-craiyon" class="flex flex-col items-center p-6 rounded-3xl border-2 transition-all group opacity-50 cursor-not-allowed bg-gray-50 dark:bg-slate-800 border-gray-100 dark:border-slate-700">
                        <div class="w-16 h-16 rounded-2xl bg-orange-500 flex items-center justify-center text-white mb-4 shadow-lg group-hover:scale-110 transition-transform">Craiyon</div>
                        <span class="font-bold text-gray-800 dark:text-gray-200">Craiyon</span>
                    </button>
                    <button onclick="window.open('https://designer.microsoft.com', '_blank')" class="flex flex-col items-center p-6 rounded-3xl border-2 transition-all group hover:border-[#A8D8EA] dark:hover:border-sky-500 bg-white dark:bg-slate-800 border-gray-100 dark:border-slate-700">
                        <div class="w-16 h-16 rounded-2xl bg-purple-600 flex items-center justify-center text-white mb-4 shadow-lg group-hover:scale-110 transition-transform">MS</div>
                        <span class="font-bold text-gray-800 dark:text-gray-200">Microsoft Designer</span>
                    </button>
                </div>
                <p id="prompt-warning" class="text-center text-sm text-red-400 dark:text-red-500 mt-4 font-bold">Please enter a description first!</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const promptInput = document.getElementById('ai-prompt');
        const styleBtns = document.querySelectorAll('.ai-style-btn');
        const generateCraiyon = document.getElementById('generate-craiyon');
        const warning = document.getElementById('prompt-warning');
        let selectedStyle = 'Cute 3D';

        styleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                styleBtns.forEach(b => {
                    b.className = "ai-style-btn px-5 py-2 rounded-full font-bold transition-all bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-300 hover:bg-gray-200";
                });
                btn.className = "ai-style-btn px-5 py-2 rounded-full font-bold transition-all bg-[#FFB7C5] dark:bg-pink-500 text-white shadow-md transform scale-105";
                selectedStyle = btn.getAttribute('data-style');
            });
        });

        promptInput.addEventListener('input', (e) => {
            const val = e.target.value.trim();
            if (val) {
                generateCraiyon.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-50');
                generateCraiyon.classList.add('hover:border-[#A8D8EA]', 'cursor-pointer', 'bg-white');
                warning.style.display = 'none';
                generateCraiyon.onclick = () => window.open(`https://www.craiyon.com/?prompt=${encodeURIComponent(val + ' in ' + selectedStyle + ' style')}`, '_blank');
            } else {
                generateCraiyon.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-50');
                generateCraiyon.classList.remove('hover:border-[#A8D8EA]', 'cursor-pointer', 'bg-white');
                warning.style.display = 'block';
                generateCraiyon.onclick = null;
            }
        });
    });
</script>

<?php get_footer(); ?>
