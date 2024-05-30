<template>
  <div id="app">
    <header>
    </header>
    <main>
      <div class="content-delimiter">
        <template v-if="!loggedUser">
          <LoginCard  :class="'box-shadow'"/>
        </template>
        <template v-else>
          <ScheduleCard :class="'box-shadow fix-size'" />
          <InsertScheduleCard v-if="loggedUser.role == 'Receptionist'" :class="'box-shadow fix-size'"/>
          <InsertAssessmentCard v-else-if="loggedUser.role == 'Doctor'" :class="'box-shadow fix-size'"/>
        </template>
      </div> 
    </main>
  </div>
</template>

<script>
  import LoginCard from './components/LoginCard.vue'
  import ScheduleCard from './components/ScheduleCard.vue'
  import InsertScheduleCard from './components/InsertScheduleCard.vue'
  import InsertAssessmentCard from './components/InsertAssessmentCard.vue'

  export default {
    name: 'App',
    data() {
      return {
        loggedUser: {
            role: "Receptionist"
        }
      };
    },
		components: {
			LoginCard,
      ScheduleCard,
      InsertScheduleCard,
      InsertAssessmentCard
		},
    methods: {
      
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

.fix-size{
  width: 100%;
  height: 40vh;
  padding: 4vw;
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

</style>