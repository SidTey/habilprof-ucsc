import React, { useState, useEffect } from 'react';
import UcscDataForm from './UcscDataForm';
import UcscDataTable from './UcscDataTable';
import UcscLogs from './UcscLogs';
import axios from 'axios';

function App() {
    const [activeTab, setActiveTab] = useState('form');
    const [registros, setRegistros] = useState([]);
    const [logs, setLogs] = useState([]);
    const [loading, setLoading] = useState(false);

    // Configurar axios con base URL
    useEffect(() => {
        axios.defaults.baseURL = '/api';
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['Content-Type'] = 'application/json';
    }, []);

    const cargarRegistros = async () => {
        try {
            setLoading(true);
            const response = await axios.get('/ucsc/registros');
            if (response.data.success) {
                setRegistros(response.data.data);
            }
        } catch (error) {
            console.error('Error cargando registros:', error);
        } finally {
            setLoading(false);
        }
    };

    const cargarLogs = async () => {
        try {
            setLoading(true);
            const response = await axios.get('/ucsc/logs');
            if (response.data.success) {
                setLogs(response.data.data);
            }
        } catch (error) {
            console.error('Error cargando logs:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (activeTab === 'registros') {
            cargarRegistros();
        } else if (activeTab === 'logs') {
            cargarLogs();
        }
    }, [activeTab]);

    const handleTabChange = (tab) => {
        setActiveTab(tab);
    };

    const handleDataSubmitted = () => {
        // Recargar registros después de enviar datos
        if (activeTab === 'registros') {
            cargarRegistros();
        }
    };

    return (
        <div className="min-h-screen bg-gray-100">
            <header className="bg-blue-600 text-white p-4">
                <div className="container mx-auto">
                    <h1 className="text-2xl font-bold">Sistema HabilProf - UCSC</h1>
                    <p className="text-blue-200">Carga automática de datos desde sistemas UCSC</p>
                </div>
            </header>

            <main className="container mx-auto py-6 px-4">
                {/* Navigation Tabs */}
                <div className="mb-6">
                    <nav className="flex space-x-8">
                        <button
                            onClick={() => handleTabChange('form')}
                            className={`py-2 px-1 border-b-2 font-medium text-sm ${
                                activeTab === 'form'
                                    ? 'border-blue-500 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            }`}
                        >
                            Carga de Datos (R1)
                        </button>
                        <button
                            onClick={() => handleTabChange('registros')}
                            className={`py-2 px-1 border-b-2 font-medium text-sm ${
                                activeTab === 'registros'
                                    ? 'border-blue-500 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            }`}
                        >
                            Registros UCSC
                        </button>
                        <button
                            onClick={() => handleTabChange('logs')}
                            className={`py-2 px-1 border-b-2 font-medium text-sm ${
                                activeTab === 'logs'
                                    ? 'border-blue-500 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            }`}
                        >
                            Logs del Sistema (R1.13)
                        </button>
                    </nav>
                </div>

                {/* Tab Content */}
                <div className="bg-white rounded-lg shadow-md p-6">
                    {activeTab === 'form' && (
                        <UcscDataForm onDataSubmitted={handleDataSubmitted} />
                    )}
                    {activeTab === 'registros' && (
                        <UcscDataTable 
                            registros={registros} 
                            loading={loading}
                            onRefresh={cargarRegistros}
                        />
                    )}
                    {activeTab === 'logs' && (
                        <UcscLogs 
                            logs={logs} 
                            loading={loading}
                            onRefresh={cargarLogs}
                        />
                    )}
                </div>
            </main>

            <footer className="bg-gray-800 text-white p-4 mt-8">
                <div className="container mx-auto text-center">
                    <p>&copy; 2025 Sistema HabilProf - Universidad Católica de la Santísima Concepción</p>
                </div>
            </footer>
        </div>
    );
}

export default App;
