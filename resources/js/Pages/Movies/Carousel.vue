<template>
    <div class="my-4 w-full relative flex items-center">
        <!-- Left Arrow -->
        <div class="absolute left-2 -ml-0.5">
            <button type="button" class="rounded-full overflow-hidden group flex p-1 relative">
                    <div class="transition-colors absolute inset-0 bg-gray-50 group-hover:bg-gray-100 opacity-50">&nbsp;</div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </button>
        </div>

        <!-- Content -->
        <div class="px-12">
            <div id="slider" class="w-full overflow-hidden">
                <div id="slide" class="w-full flex gap-x-2 relative transition-all border border-gray-500">
                    <!-- Cards -->
                    <div v-for="item in items" :key="item.id" class="rounded-md border border-gray-200 divide-y divide-gray-200 flex flex-col justify-between items-center overflow-hidden" style="min-width: 19.05%; max-width: 19.05%">
                        <!-- Image -->
                        <div class="object-cover h-full flex items-center justify-center bg-gray-50 slider-card">
                            <img :src="item.image_url" alt="">
                        </div>

                        <!-- Heading -->
                        <button type="button" class="transition-colors bg-blue-50 hover:bg-blue-100 text-center w-full py-1 px-2">
                            {{ item.title }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Arrow -->
        <div class="absolute right-2 -mr-0.5">
            <button type="button" class="rounded-full overflow-hidden group flex p-1 relative">
                    <div class="transition-colors absolute inset-0 bg-gray-50 group-hover:bg-gray-100 opacity-50">&nbsp;</div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                {
                    title: "Hello World",
                    image_url: "https://m.media-amazon.com/images/I/A1CzQSue4rL._AC_SL1500_.jpg"
                },
                {
                    title: "Lorem Ipsum",
                    image_url: "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpg"
                },
                {
                    title: "Super Test",
                    image_url: "https://static.posters.cz/image/750/posters/avengers-endgame-i-am-iron-man-i76482.jpg"
                },
                {
                    title: "Sarah Brennan",
                    image_url: "https://terrigen-cdn-dev.marvel.com/content/prod/1x/snh_online_6072x9000_posed_01.jpg"
                },
                {
                    title: "Ryan Dawkes",
                    image_url: "https://i.pinimg.com/originals/7c/f1/d4/7cf1d4975f1faf4a009c1398e8462886.jpg"
                },
                {
                    title: "Next Lot",
                    image_url: "https://m.media-amazon.com/images/I/A1CzQSue4rL._AC_SL1500_.jpg"
                },
                {
                    title: "No 6",
                    image_url: "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpg"
                },
                {
                    title: "No 7",
                    image_url: "https://static.posters.cz/image/750/posters/avengers-endgame-i-am-iron-man-i76482.jpg"
                },
                {
                    title: "No 8",
                    image_url: "https://terrigen-cdn-dev.marvel.com/content/prod/1x/snh_online_6072x9000_posed_01.jpg"
                },
                {
                    title: "No 9",
                    image_url: "https://i.pinimg.com/originals/7c/f1/d4/7cf1d4975f1faf4a009c1398e8462886.jpg"
                },
            ],
            translateValue: 0
        }
    },
    created() {
    },
    methods: {
    },
    // props: [
    //     'items'
    // ]
}
</script>
