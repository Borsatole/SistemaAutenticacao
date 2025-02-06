import { createContext, useState, useEffect } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

// Criando o contexto de autenticação
export const AuthContext = createContext();

export function AuthProvider({ children }) {
  const navigate = useNavigate();
  const [auth, setAuth] = useState({
    token: localStorage.getItem("token"),
    loggedIn: !!localStorage.getItem("token"),
  });

  // Verifica o token ao iniciar
  useEffect(() => {
    if (auth.token) {
      verificaToken(auth.token);
    }
  }, [auth.token]); // Só executa quando o token muda

  // Função para validar o token na API
  async function verificaToken(token) {
    try {
      const response = await axios.post(
        "http://localhost/Backend/Auth/Token/valida-jwt.php",
        { token: token }
      );

      if (!response.data.success) {
        console.log("Token expirado! Deslogando usuário...");
        logout();
      }
    } catch (error) {
      console.error("Erro na verificação do token:", error);
      logout();
    }
  }

  // Função para realizar login e armazenar o token
  const login = (token) => {
    localStorage.setItem("token", token);
    setAuth({ token, loggedIn: true });
  };

  // Função para logout com redirecionamento correto
  const logout = () => {
    localStorage.removeItem("token");
    setAuth({ token: null, loggedIn: false });

    // Evita erros de navegação antes da atualização do estado
    setTimeout(() => {
      navigate("/login", { replace: true });
    }, 100);
  };

  return (
    <AuthContext.Provider value={{ auth, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}
