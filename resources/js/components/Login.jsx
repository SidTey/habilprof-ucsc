import { useState } from 'react';
import axios from 'axios';

// (Estilos básicos, puedes ponerlos en tu app.css si prefieres)
const styles = {
    container: { fontFamily: 'sans-serif', display: 'grid', placeItems: 'center', minHeight: '90vh' },
    form: { border: '1px solid #ccc', padding: '20px', borderRadius: '8px', background: '#f9f9f9', minWidth: '350px' },
    formGroup: { marginBottom: '15px' },
    label: { display: 'block', marginBottom: '5px', fontWeight: 'bold' },
    input: { width: '100%', boxSizing: 'border-box', padding: '8px', border: '1px solid #ddd', borderRadius: '4px' },
    button: { width: '100%', padding: '10px', backgroundColor: '#007bff', color: 'white', border: 'none', borderRadius: '4px', cursor: 'pointer' },
    error: { color: 'red', fontSize: '0.9em', marginTop: '5px' },
    success: { color: 'green', marginTop: '10px', border: '1px solid green', padding: '10px' }
};

export default function Login({ onLoginSuccess, onShowRegister }) {
    // Estados para los campos del formulario
    const [rut, setRut] = useState('');
    const [password, setPassword] = useState('');
    const [remember, setRemember] = useState(false);

    // Estados para los mensajes
    const [errors, setErrors] = useState({});
    const [generalError, setGeneralError] = useState('');


    const handleSubmit = async (e) => {
        e.preventDefault(); // Evita que la página se recargue
        setErrors({});
        setGeneralError('');


        try {
            // Petición POST a la ruta /login que definimos en web.php
            const response = await axios.post('/login', {
                rut_profesor: rut,
                password: password,
                remember: remember
            });


            // Llamar al callback para notificar al componente padre
            if (onLoginSuccess) {
                onLoginSuccess(response.data.profesor);
            }

        } catch (error) {
            // Manejar errores de Laravel
            if (error.response) {
                if (error.response.status === 422) {
                    // R5.2.1, R5.2.2, R5.3: Errores de validación
                    if (error.response.data.errors) {
                        setErrors(error.response.data.errors);
                    } else {
                        // Este error es para "rut incorrecto" o "contraseña incorrecta"
                        setGeneralError(error.response.data.message);
                    }
                } else if (error.response.status === 429) {
                    // R5.6.2: Cuenta bloqueada
                    setGeneralError(error.response.data.message);
                } else {
                    setGeneralError('Ha ocurrido un error inesperado.');
                }
            } else {
                setGeneralError('Error de red o el servidor no responde.');
            }
        }
    };

    return (
        <div style={styles.container}>
            <form onSubmit={handleSubmit} style={styles.form}>
                <h2 style={{ textAlign: 'center' }}>Iniciar Sesión</h2>

                {/* Muestra errores generales (RUT/Pass mal, Cuenta bloqueada) */}
                {generalError && <div style={{ ...styles.error, padding: '10px', background: '#ffebee', marginBottom: '10px' }}>{generalError}</div>}


                <div style={styles.formGroup}>
                    <label htmlFor="rut_profesor">RUT Profesor</label>
                    <input
                        type="text"
                        id="rut_profesor"
                        value={rut}
                        onChange={(e) => setRut(e.target.value)}
                        required
                        style={styles.input}
                    />
                    {/* Muestra error de formato de RUT (R5.3) */}
                    {errors.rut_profesor && <div style={styles.error}>{errors.rut_profesor[0]}</div>}
                </div>

                <div style={styles.formGroup}>
                    <label htmlFor="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        style={styles.input}
                    />
                    {/* Muestra error de formato de contraseña */}
                    {errors.password && <div style={styles.error}>{errors.password[0]}</div>}
                </div>

                <div style={styles.formGroup}>
                    <input
                        type="checkbox"
                        id="remember"
                        checked={remember}
                        onChange={(e) => setRemember(e.target.checked)}
                    />
                    <label htmlFor="remember" style={{ display: 'inline', fontWeight: 'normal', marginLeft: '5px' }}>
                        Recuérdame
                    </label>
                </div>

                <div>
                    <button type="submit" style={styles.button}>Iniciar Sesión</button>
                </div>

                {/* R5.7: "Olvidé mi contraseña" (Aún por implementar) */}
                <a
                   href="#"
                   onClick={() => alert('Función "Olvidé mi contraseña" pendiente de implementar.')}
                   style={{ marginTop: '15px', display: 'block', textAlign: 'center' }}
                >
                    Olvidé mi contraseña
                </a>

                <a
                onClick={onShowRegister}
                style={{
                    marginTop: '10px',
                    display: 'block',
                    textAlign: 'center',
                    cursor: 'pointer',
                    color: '#28a745' // Color verde
                    }}
                >
                    ¿No tienes cuenta? Regístrate
                </a>
            </form>
        </div>
    );
}
