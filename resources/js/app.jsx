import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/App';
import './bootstrap';

const rootElement = document.getElementById('app');
if (rootElement) {
    const root = createRoot(rootElement);
    root.render(
        <StrictMode>
            <App />
        </StrictMode>
    );
}
