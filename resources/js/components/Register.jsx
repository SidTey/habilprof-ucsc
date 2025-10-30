import { useState } from 'react';
import axios from 'axios';

// (Usamos los mismos estilos del Login para consistencia)
const styles = {
    container: { fontFamily: 'sans-serif', display: 'grid', placeItems: 'center', minHeight: '90vh' },
    form: { border: '1px solid #ccc', padding: '20px', borderRadius: '8px', background: '#f9f9f9', minWidth: '350px' },
    formGroup: { marginBottom: '15px' },
    label: { display: 'block', marginBottom: '5px', fontWeight: 'bold' },
    input: { width: '100%', boxSizing: 'border-box', padding: '8px', border: '1px solid #ddd', borderRadius: '4px' },
    button: { width: '100%', padding: '10px', backgroundColor: '#28a745', color: 'white', border: 'none', borderRadius: '4px', cursor: 'pointer' },
    error: { color: 'red', fontSize: '0.9em', marginTop: '5px' },
    success: { color: 'green', fontSize: '0.9em', marginTop: '5px', padding: '10px', border: '1px solid green', background: '#e6ffed' },
    toggleLink: { marginTop: '15px', display: 'block', textAlign: 'center', cursor: 'pointer', color: '#007bff' }
};

// Esta prop 'onShowLogin' la usaremos en el Paso 9 para volver al login
export default function Register({ onShowLogin }) {

    // --- Estados para los campos del formulario ---
    const [nombre, setNombre] = useState('');
    const [rut, setRut] = useState('');
    const [correo, setCorreo] = useState(''); // <-- El campo nuevo para 'Opción B'
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('');

    // --- Estados para los mensajes de error/éxito ---
    const [errors, setErrors] = useState({});
    const [generalError, setGeneralError] = useState('');
    const [successMessage, setSuccessMessage] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Limpia los mensajes de intentos anteriores
        setErrors({});
        setGeneralError('');
        setSuccessMessage('');

        try {
            // Llama a la ruta /api/register que creamos en el Paso 7
            const response = await axios.post('/register', {
                nombre_profesor: nombre,
                rut_profesor: rut,
                correo_profesor: correo, // <-- Enviamos el correo
                password: password,
                password_confirmation: passwordConfirmation
            });

            // ¡Éxito! Muestra el mensaje y limpia el formulario
            setSuccessMessage(response.data.message + " Ahora puedes iniciar sesión.");
            setNombre('');
            setRut('');
            setCorreo('');
            setPassword('');
            setPasswordConfirmation('');

        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Errores de validación (ej: RUT ya existe, contraseñas no coinciden)
                setErrors(error.response.data.errors);
            } else {
                // Error 500 o de red
                console.error(error);
                setGeneralError('Ha ocurrido un error inesperado al registrar.');
            }
        }
    };

    return (
        <div style={styles.container}>
            <form onSubmit={handleSubmit} style={styles.form}>
                <h2 style={{ textAlign: 'center' }}>Registrar Profesor</h2>

                {/* Muestra errores generales o de éxito */}
                {generalError && <div style={{...styles.error, background: '#ffebee', padding: '10px'}}>{generalError}</div>}
                {successMessage && <div style={styles.success}>{successMessage}</div>}

                {/* Campo Nombre */}
                <div style={styles.formGroup}>
                    <label htmlFor="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" value={nombre} onChange={(e) => setNombre(e.target.value)} required style={styles.input} />
                    {errors.nombre_profesor && <div style={styles.error}>{errors.nombre_profesor[0]}</div>}
                </div>

                {/* Campo RUT */}
                <div style={styles.formGroup}>
                    <label htmlFor="rut">RUT (sin puntos, sin guion)</label>
                    <input type="text" id="rut" value={rut} onChange={(e) => setRut(e.target.value)} required style={styles.input} />
                    {errors.rut_profesor && <div style={styles.error}>{errors.rut_profesor[0]}</div>}
                </div>

                {/* Campo Correo */}
                <div style={styles.formGroup}>
                    <label htmlFor="correo">Correo Electrónico</label>
                    <input type="email" id="correo" value={correo} onChange={(e) => setCorreo(e.target.value)} required style={styles.input} />
                    {errors.correo_profesor && <div style={styles.error}>{errors.correo_profesor[0]}</div>}
                </div>

                {/* Campo Contraseña */}
                <div style={styles.formGroup}>
                    <label htmlFor="password">Contraseña (mín. 8 caracteres)</label>
                    <input type="password" id="password" value={password} onChange={(e) => setPassword(e.target.value)} required style={styles.input} />
                    {errors.password && <div style={styles.error}>{errors.password[0]}</div>}
                </div>

                {/* Campo Confirmar Contraseña */}
                <div style={styles.formGroup}>
                    <label htmlFor="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" value={passwordConfirmation} onChange={(e) => setPasswordConfirmation(e.target.value)} required style={styles.input} />
                </div>

                {/* Botón de Enviar */}
                <div>
                    <button type="submit" style={styles.button}>Registrarme</button>
                </div>

                {/* Enlace para volver al Login */}
                <a onClick={onShowLogin} style={styles.toggleLink}>
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </form>
        </div>
    );
}
