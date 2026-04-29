<?php
/**
 * Template Name: Characters Gallery
 */
get_header(); 
?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="text-center mb-12">
        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mb-4">Meet the Characters</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Download high-quality coloring pages and vector art of your favorites!</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <?php
        $char_query = new WP_Query(array(
            'post_type'      => 'character',
            'posts_per_page' => -1,
        ));

        if ($char_query->have_posts()) :
            while ($char_query->have_posts()) : $char_query->the_post();
                $download_url = get_post_meta(get_the_ID(), 'high_res_download', true) ?: '#';
                ?>
                <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] border border-gray-50 dark:border-slate-700 flex flex-col items-center p-8 text-center bg-gradient-to-b from-white to-gray-50 dark:from-slate-800 dark:to-slate-800/80 transition-transform hover:-translate-y-2 duration-300">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-8 border-white dark:border-slate-700 shadow-lg mb-6 bg-[#A8D8EA]/20 dark:bg-sky-900/30">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal')); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-sky-100 dark:bg-sky-900/50"></div>
                        <?php endif; ?>
                    </div>
                    <h3 class="font-bold text-2xl text-gray-800 dark:text-gray-200 mb-4"><?php the_title(); ?></h3>
                    <button onclick="handleDownloadClick('<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_js($download_url); ?>')" class="w-full px-6 py-3 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-95 border-2 border-[#FFB7C5] text-pink-500 hover:bg-pink-50 dark:border-pink-500 dark:text-pink-400 dark:hover:bg-slate-800 shadow-sm hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download Free
                    </button>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="col-span-full text-center text-gray-500">No characters found.</p>';
        endif;
        ?>
    </div>
</div>

<!-- Subscription Modal Logic -->
<div id="download-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-200">
    <div class="bg-white dark:bg-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl relative scale-in-center border dark:border-slate-700 text-center">
        <button onclick="closeModal()" class="absolute top-4 right-4 p-2 bg-gray-100 dark:bg-slate-700 rounded-full hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors z-10 dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
        
        <div class="w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 dark:text-red-400 ml-1"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        </div>
        <h2 class="font-['Bubblegum_Sans'] text-3xl text-gray-800 dark:text-gray-100 mb-4">Subscriber Exclusive!</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-8">
            To download <strong id="modal-char-name">Character</strong>, please subscribe to Julia's Cartoonery on YouTube. It's free and helps us make more cartoons!
        </p>
        
        <div id="modal-unverified" class="space-y-4">
            <button class="w-full px-6 py-3 rounded-full font-bold transition-all flex items-center justify-center bg-red-500 text-white hover:bg-red-600 shadow-sm" onclick="window.open('https://youtube.com', '_blank')">
                1. Subscribe to Channel
            </button>
            <button id="verify-btn" onclick="verifySubscription()" class="w-full px-6 py-3 rounded-full font-bold transition-all flex items-center justify-center bg-gray-800 dark:bg-slate-700 text-white hover:bg-black dark:hover:bg-slate-600 shadow-sm disabled:bg-gray-400 dark:disabled:bg-slate-800">
                2. I've Subscribed - Verify & Download
            </button>
        </div>

        <div id="modal-verified" class="hidden bg-green-50 dark:bg-emerald-900/30 text-green-600 dark:text-emerald-400 p-4 rounded-xl flex items-center justify-center gap-2 font-bold animate-in zoom-in">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg> Verified! Downloading...
        </div>
    </div>
</div>

<script>
    let activeDownloadUrl = '';
    
    function handleDownloadClick(name, url) {
        document.getElementById('modal-char-name').innerText = name;
        activeDownloadUrl = url;
        
        // Reset modal state
        document.getElementById('modal-unverified').classList.remove('hidden');
        document.getElementById('modal-verified').classList.add('hidden');
        document.getElementById('verify-btn').disabled = false;
        document.getElementById('verify-btn').innerHTML = "2. I've Subscribed - Verify & Download";
        
        document.getElementById('download-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('download-modal').classList.add('hidden');
    }

    function verifySubscription() {
        const btn = document.getElementById('verify-btn');
        btn.disabled = true;
        btn.innerHTML = '<div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div> Verifying...';
        
        setTimeout(() => {
            document.getElementById('modal-unverified').classList.add('hidden');
            document.getElementById('modal-verified').classList.remove('hidden');
            
            setTimeout(() => {
                closeModal();
                if(activeDownloadUrl && activeDownloadUrl !== '#') {
                    window.open(activeDownloadUrl, '_blank');
                } else {
                    alert('Download initiated! (Demo)');
                }
            }, 1500);
        }, 2000);
    }
</script>

<?php get_footer(); ?>
