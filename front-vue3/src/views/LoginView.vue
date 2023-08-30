<template>
  <div class="bodyLoginPage">
    <HelloWorld msg="Sign in" />

    <el-form class="loginForm" ref="loginForm" :model="loginData" label-position="top" status-icon>
      <el-form-item label="Username" label-width="100px" prop="username" :rules="[
        {
          required: true,
          message: 'Please input username!',
          trigger: 'blur'
        }
      ]">
        <el-input v-model="loginData.username" size="large" :prefix-icon="User" />
      </el-form-item>
      <el-form-item label="Password" label-width="100px" prop="password" :rules="[
        {
          required: true,
          message: 'Please input password!',
          trigger: 'blur'
        }
      ]">
        <el-input v-model="loginData.password" type="password" autocomplete="off" show-password size="large"
          :prefix-icon="Lock" />
      </el-form-item>

      <el-row justify="end">
        <el-form-item>
          <el-button size="large" @click="login" v-loading.fullscreen.lock="loadingBtn">Log in</el-button>
        </el-form-item>
      </el-row>
    </el-form>
  </div>
</template>

<script setup>
import { ElMessage } from 'element-plus'
import { inject, ref } from 'vue'
import router from '../router';
import { User, Lock } from '@element-plus/icons-vue'

const post = inject('post')

const loginData = ref({
  username: '',
  password: ''
})

const loadingBtn = ref(false)

const loginForm = ref(null)

async function login() {
  loginForm.value.validate(async (valid) => {
    if (!valid) {
      ElMessage({
        message: 'Error',
        type: 'error'
      })
    } else {
      try {
        loadingBtn.value = true

        var formdata = new FormData();
        formdata.append('username', loginData.value.username)
        formdata.append('password', loginData.value.password)

        var response = await post('/login/login', formdata)

        if (response.status == 200) {
          var token = response.data.token
          var username = response.data.username

          window.sessionStorage.setItem('token', token)
          window.sessionStorage.setItem('username', username)

          router.push('/dashboard');
        }

      } catch (error) {
        ElMessage({
          message: error.response.data.error ?? 'Eroare API',
          type: 'error'
        })
        console.error('Login error:', error)
      } finally {
        loadingBtn.value = false
      }
    }
  })
}
</script>


<style scoped>
.bodyLoginPage {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: center;
  align-content: center;
  min-height: 100vh;
  gap: 40px;
  padding: 2rem;
}

.el-form {
  width: 100%;
  max-width: 400px;
}
</style>