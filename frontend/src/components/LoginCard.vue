<template>
  <div class="loginCard">  
    <h1>Formulário</h1>
    <form @submit.prevent="submitForm">
      <label for="user_id">ID do Usuário:</label>
      <input type="text" id="user_id" v-model="userId">
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  export default {
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
