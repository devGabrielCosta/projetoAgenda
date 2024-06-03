<template>
  <RouterView />
  <notifications class="customize-notification" position="bottom right"/>
</template>

<script>  
  import { RouterView } from 'vue-router';

  export default {
    name: 'App',
    components:{
      RouterView
    }
  };
</script>

<style>

  #app{
    display: flex;
    flex-direction: column;
  }

  html{ 
    font-size: 16px;
    font-family: sans-serif;
  }

  .box-shadow{
    box-shadow: 0px 0px 17px -1px rgba(0,0,0,0.75);
  }

  button {
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }

  .customize-notification {
    .notification-content {
      font-size: 1.5rem;
    }
    /*&.success {
    }
    &.info {
    }
    &.error {
    }*/
  }

</style>