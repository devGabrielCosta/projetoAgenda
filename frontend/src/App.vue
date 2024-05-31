<template>
  <div id="app">
    <header>  
      <button v-if="store.loggedUser" @click="logout">Logout</button>
    </header>
    <main>
      <div class="content-delimiter">
        <template v-if="!store.loggedUser">
          <LoginCard  :class="'box-shadow fix-padding'"/>
        </template>
        <template v-else>
          <ScheduleCard :class="'box-shadow fix-size fix-padding'" />
          <InsertScheduleCard v-if="store.loggedUser.type == 'Receptionist'" :class="'box-shadow fix-size fix-padding'"/>
          <InsertAssessmentCard v-else-if="store.loggedUser.type == 'Doctor' && store.selectedSchedule" :class="'box-shadow fix-size fix-padding'"/>
        </template>
      </div> 
    </main>
    <notifications class="customize-notification" position="bottom right"/>
  </div>
</template>

<script>
  import LoginCard from './components/LoginCard.vue'
  import ScheduleCard from './components/ScheduleCard.vue'
  import InsertScheduleCard from './components/InsertScheduleCard.vue'
  import InsertAssessmentCard from './components/InsertAssessmentCard.vue' 

  export default {
    name: 'App',
		components: {
			LoginCard,
      ScheduleCard,
      InsertScheduleCard,
      InsertAssessmentCard
		},
    methods: {
      logout(){
        this.store.loggedUser = null;
        this.store.selectedSchedule = null;
      }
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

header{
  background-color: black;
  height: 4vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

main{
  background-color: rgb(216, 206, 206);
  height: 96vh;
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
  padding: 2vh;
}

.fix-size{
  width: 100%;
  height: 40vh;
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