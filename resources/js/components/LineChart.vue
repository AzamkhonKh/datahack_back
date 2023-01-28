<template>

    <la-cartesian narrow :bound="[0, n => n + 100]" :data="values" :colors="colors" :padding="[0, 0, 5, 0]">
      <template v-for="metric in metrics">
      <la-line curve dot :width="2" 
        :prop="metric"
        :label="metric.split(',')[0]"
        >
        <g
        slot-scope="props"
        :fill="props.color">
          <rect
            :x="props.x"
            :y="props.y"
            width="5"
            height="5">
          </rect>
          <text
            :x="props.x"
            :y="props.y"
            text-anchor='middle'
            dy="-.5em">
          </text>
        </g>
      </la-line>
      </template>
      <la-y-axis :nbTicks="3"></la-y-axis>
      <la-x-axis prop="x" :format="dateFormatter"></la-x-axis>
      <la-tooltip>
      </la-tooltip>
    </la-cartesian>
  </template>
  
  <script>
  import moment from "moment";
  export default {
    name: "LineChart",
    props: {
      values: Array,
      metrics: Array
    },
    methods: {
      dateFormatter: function(value) {
        return moment(value).format("MMM YY");
      }
    },
    data() {
      return {
        colors: [
          "#7DB3FF",
          "#49457B",
          "#FF7C78",
          "#FED3D0",
          "#6F76D9",
          "#9ADFB4",
          "#2E7987"
        ]
      };
    },
    mounted() {
      console.log(this.values);
    },
  };
  </script>
  
  <style scoped>
  </style>
  