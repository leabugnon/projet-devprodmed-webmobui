import axios from "axios";

const instance = axios.create({
  baseURL: "http://localhost:8000", // Remplacez par l'URL de votre backend
  withCredentials: true, // Important pour inclure les cookies
});

// Ajout automatique du token CSRF
instance.interceptors.request.use((config) => {
  const token = document.cookie
    .split("; ")
    .find((row) => row.startsWith("XSRF-TOKEN="))
    ?.split("=")[1];
  if (token) {
    config.headers["X-XSRF-TOKEN"] = decodeURIComponent(token);
  }
  return config;
});

export default instance;
