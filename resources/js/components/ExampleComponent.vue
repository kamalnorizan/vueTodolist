<template>
  <div>
    <button :type="test.type" v-text="test.text"></button>
    {{perkataan}} {{type}}
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");

    axios.get("api/vue", {}).then(response => {
      this.test = response.data;
    });
  },

  data: function() {
    return {
      test: ""
    };
  },
  props: ["perkataan", "type"]
};
</script>
