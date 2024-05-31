<template>
  <div class="loginCard">  
    <h1>Login</h1>
    <form @submit.prevent="sendForm">
      <label for="user_id">ID do Usuário:</label>
      <input type="text" id="user_id" v-model="userId" required>
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  export default {
    data() {
      return {
        userId: ""
      };
    },
    methods: {
      sendForm()
      { 
        this.$store.dispatch('login', this.userId)
          .then(() => {
              this.$router.push('/');
          })
          .catch(() => {
            this.$notify({
              text: "Usuário não encotrado",
              type: "error"
            });
          })
      }
    }
  }

</script>

<style scoped>

  .loginCard{
    background-color: white;

      form {
      margin-top: 20px;
      }
      label {
        display: block;
        margin-bottom: 5px;
      }
      input[type="text"] {
        width: 200px;
        padding: 5px;
        margin-bottom: 10px;
      }
  }

</style>
