<template>
  <main>
    <div class="content-delimiter">
        <LoginCard  :class="'box-shadow fix-padding'"/>
    </div> 
  </main>
</template>

<script>
  import LoginCard from '../components/LoginCard.vue'

  export default {
		components: {
			LoginCard
		}
  };
</script>

<style>

  #app{
    display: flex;
    flex-direction: column;
  }

  header{
    background-color: black;
    height: 4vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  main{
    background-color: rgb(216, 206, 206);
    height: 100vh;
  }

  .content-delimiter{
    width: min(95vw, 1080px);
    height: 100%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    gap: 3vh;
  }

  .fix-padding{
    padding: 5vh;
  }

</style>