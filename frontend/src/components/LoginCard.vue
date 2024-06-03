<template>
  <div class="login-card">  
    <h1>Login</h1>
    <form @submit.prevent="sendForm">
      <label for="user_id">ID do Usuário:</label>
      <input type="text" id="user_id" v-model="userId" required><br/>
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

  .login-card{
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;

      form {
        margin-top: 2rem;
      
        label {
          display: block;
          margin-bottom: 0.5rem;
        }

        input {
          margin-bottom: 2rem;
        }
        
        button{
          float: right;
        }
      }
  }

</style>
