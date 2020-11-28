<template>
  <div>
  <h1>Dashboard HOME</h1>
  </div>
</template>

<script>
export default {
  layout: 'dashboard',
  middleware: ['permissions'],
  meta: {
    permissions: [
      'dashboard.show'
    ]
  },
  data () {
    return {
    };
  },

};
</script>
