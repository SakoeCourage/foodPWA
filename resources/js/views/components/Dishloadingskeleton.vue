<template>
    <div>
        <nav class="shadow-md animate-pulse ">
          <nav class="flex items-center justify-between mb-2 ">
            <span class=" flex items-center gap-2">
              <span class="h-6 w-6 aspect-square bg-gray-100 rounded-full">
                &nbsp; 
              </span>
            <span class="flex flex-col text-sm gap-0 leading-none ">
              <span class="bg-gray-100 font-semibold h-3 w-16 mb-1"> &nbsp;</span>
              <span class="text-xs bg-gray-50 h-3 w-12"> &nbsp;</span>
            </span>
          </span>
            <span class=" cursor-pointer opacity-40" >
                
              <font-awesome-icon icon="ellipsis-v" />
            
            </span>
           

          </nav>
         <nav class=" aspect-square overflow-hidden  rounded-md block relative bg-gray-100">
            
              <nav class="absolute inset-0   z-10">
                <nav class="w-full h-full relative">
                  <span class="absolute top-5 right-5 px-2 w-3/12 rounded-md bg-orange-100 ">&nbsp;</span>
                  <nav class="absolute bottom-0 h-[30%] w-full  flex items-end pl-5 pb-5 ">
                    <nav class=" bg-gray-200/80 w-1/2 h-4 ">&nbsp; </nav>
                  </nav>
                </nav>
              </nav>
        
         </nav>
        </nav>
    </div>
</template>

<script setup>


</script>


<style scoped>

.fade-enter-active{
  transition: all 0.5s ease;
}
.fade-leave-active {
  transition: all 0.1s ease;
}

.fade-enter-from{
  transform: translateY(10px);
  opacity: 0;
}
.fade-leave-to {
  opacity: 1;

 
}


</style>