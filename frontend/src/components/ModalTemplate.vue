<template>
  <transition name="BaseModalTemplate">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <button class="modal-default-button red" @click="$emit('close')">
              X
            </button>
          </div>

          <div class="modal-body">
            <slot></slot>
          </div>

          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
  
<script>

  export default {   
  }

</script>

<style scoped>

  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
  }

  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }

  .modal-container {
    width: max(300px, 15vw);
    padding: 2vh 2vh;
    margin: 0px auto;
    background-color: white;  
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }

  .modal-default-button {
    float: right;
    padding: 0.3rem 0.6rem;
    background-color: rgb(182, 0, 0);
    color: white;
    min-width: 0;
  }

  .modal-default-button:hover {
    background-color: rgb(134, 0, 0);
  }

  .modal-enter {
    opacity: 0;
  }

  .modal-leave-active {
    opacity: 0;
  }

  .modal-enter .modal-container,
  .modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }

</style>
