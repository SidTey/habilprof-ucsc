import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/App';
import './bootstrap';

// Crear el punto de entrada de React
if (document.getElementById('app')) {
    const root = ReactDOM.createRoot(document.getElementById('app'));
    root.render(<App />);
}
