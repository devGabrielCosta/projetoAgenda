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
    box-shadow: 0px 0px 20px -10px rgba(0,0,0,0.75);
  }

  textarea, 
  input,
  select{
    padding: 0.5rem;
  }  

  button {
    padding: 0.5rem 1rem;
    background-color: #007bff;
    border-radius: 5px;
    color: white;
    border: none;
    cursor: pointer;
    min-width: 5rem;
  }

  button:hover {
    background-color: #0056b3;
  }
  
  button[class='green']{ 
    background-color: rgba(7, 160, 7);
  }
  button[class='green']:hover{ 
    background-color: rgba(6, 108, 6);
  }

  button[class='red']{ 
    background-color: rgba(160, 10, 10);
  }
  button[class='red']:hover{ 
    background-color: rgb(123, 10, 10);
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

  .content-delimiter{
    width: min(100vw, 1080px);
    height: 100%;
    margin: 0 auto;
    padding: 2vh 0;
    display: flex;
    flex-direction: column;
    gap: 2vh;
  }

</style>