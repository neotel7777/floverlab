<template>
    <li class="d-flex align-items-center">
        <a class="font-14-16-normal color-green"
           :href="route('blog_tag.blog_posts.index',tag.slug)">#{{ tag.translations[0].name}}
        </a>
    </li>
</template>
<script >
export default {
    props: ['tag'],
}

</script>
