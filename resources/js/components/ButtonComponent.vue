<template>
  <button :class="classes" @click="clicked(index)">{{name}}</button>
</template>

<script>
export default {
    props: {
        name: {},
        clicked: {},
        classes:{},
        index:{}
    }
}
</script>

<style>

</style>
