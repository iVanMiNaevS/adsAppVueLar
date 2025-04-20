<template>
  <div class="notifications-container">
    <transition-group name="notification-list" tag="div">
      <div
        v-for="notification in notifications"
        :key="notification.id"
        class="notification"
        :class="'notification-' + notification.type"
      >
        <div class="notification-content">
          <h4 v-if="notification.title">{{ notification.title }}</h4>
          <p>{{ notification.message }}</p>
          <small>{{ notification.timestamp }}</small>
        </div>
        <button
          class="close-button"
          @click="removeNotification(notification.id)"
          aria-label="Close notification"
        >
          &times;
        </button>
      </div>
    </transition-group>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const ws = ref(null);
const notifications = ref([]);

function connectWs(){
  ws.value = new WebSocket("ws://localhost:3000");

  ws.value.onopen = (e) => {
    console.log("Connection opened");
  }

  ws.value.onmessage = (e) => {
    const data = JSON.parse(e.data);
    console.log(data);
    addNotification({id: data.ad.id, title: data.ad.title, message: data.message, timestamp: data.timestamp});
  }
}

function addNotification(notification){
  const newNotification = {
    id: notification.id,
    title: notification.title,
    message: notification.message,
    timestamp: notification.timestamp,
  }
  notifications.value.push(newNotification);

  setTimeout(()=>{
    notifications.value.filter((note)=> note.id !== notification.id);
  },5000)
}

onMounted(() => {connectWs()})
onBeforeUnmount(() => {ws.value.close()})
</script>

<style scoped>
.notifications-container {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 1000;
  max-width: 350px;
}

.notification {
  position: relative;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  transition: all 0.3s ease;
}

.notification-info {
  border-left: 4px solid #3498db;
}

.notification-success {
  border-left: 4px solid #2ecc71;
}

.notification-error {
  border-left: 4px solid #e74c3c;
}

.notification-content {
  flex: 1;
}

.notification-content h4 {
  margin: 0 0 5px 0;
  font-size: 1em;
}

.notification-content p {
  margin: 0;
  font-size: 0.9em;
}

.notification-content small {
  color: #7f8c8d;
  font-size: 0.8em;
}

.close-button {
  background: none;
  border: none;
  color: #7f8c8d;
  cursor: pointer;
  font-size: 1.2em;
  margin-left: 10px;
  padding: 0;
  align-self: flex-start;
}

.close-button:hover {
  color: #333;
}

.notification-list-enter-active,
.notification-list-leave-active {
  transition: all 0.5s ease;
}

.notification-list-enter-from,
.notification-list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

.notification-list-move {
  transition: transform 0.5s ease;
}
</style>