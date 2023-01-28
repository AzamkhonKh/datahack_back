<template>
    <la-cartesian autoresize narrow :data="values" :colors="colors" :padding="[0, 0, 5, 0]">
      <template v-for="metric in metrics">
        <la-bar :prop="metric" :width="1" :label="metric.split(',')[0]"></la-bar>
      </template>
      <la-y-axis :nbTicks="4"></la-y-axis>
      <la-x-axis prop="x" :format="dateFormatter"></la-x-axis>
      <la-tooltip/>
    </la-cartesian>
  </template>
  
  <script>
  import moment from "moment";
  export default {
    name: "BarChart",
    props: {
      values: Array,
      metrics: Array
    },
    methods: {
      dateFormatter: function(value) {
        return moment(value).format("MM/YY");
      }
    },
    data() {
      return {
        colors: [
          "#7DB 3FF",
          "#49457B",
          "#FF7C78",
          "#FED3D0",
          "#6F76D9",
          "#9ADFB4",
          "#2E7987"
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  </style>
  