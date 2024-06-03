<template>
  <main class="login-main">
    <div class="content-delimiter">
        <LoginCard  :class="'box-shadow card'"/>
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

<style scoped>

  .login-main{
    background-color: rgb(216, 206, 206);
    height: 100vh;
  }

  .content-delimiter{
    align-items: center;
    justify-content: space-around;
  }

  .card{
    padding: 5vh;
    border-radius: 15px;
  }

</style>