<template>
    <div>
       <main>
        <nav class="text-xs w-full text-center pt-2 italic">graph showing how well this dish is patronized over the times</nav>
        <div id="canvas" class="h-56 w-full ">

        </div>
       </main>
    </div>
</template>

<script setup>
import { onMounted } from '@vue/runtime-core';
import  * as echarts from 'echarts';


var option;

option = {
    title:{
       
    },
  xAxis: {
    type: 'category',
    data: ['2015', '2016', '2017', '2018', '2020', '2021', '2022']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [820, 932, 901, 934, 1290, 1330, 1320],
      type: 'line',
      smooth: true
    }
  ],
  theme: '#fff'
};

onMounted(()=>{
    var chartDom = document.getElementById('canvas');
    var myChart = echarts.init(chartDom);
    option && myChart.setOption(option);
})






</script>