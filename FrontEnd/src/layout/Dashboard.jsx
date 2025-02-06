import { useContext } from "react";
import { AuthContext } from "../context/AuthContext";

export default function Dashboard() {
  const { logout } = useContext(AuthContext); // Obtém a função de logout

  return (
    <div>
      <h1>Bem-vindo ao Sistema!</h1>
      <button onClick={logout} style={{ cursor: "pointer" }}>
        Sair
      </button>
    </div>
  );
}
