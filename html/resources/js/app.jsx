// resources/js/app.jsx

import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import PropertyList from './components/PropertyList';
import ProvinceProperties from './components/ProvinceProperties';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<PropertyList />} />
        {/* Dynamic route สำหรับ province */}
        <Route path="/:province" element={<ProvinceProperties />} />
        {/* 404 Page */}
        <Route path="*" element={<h1>404 Not Found</h1>} />
      </Routes>
    </Router>
  );
};

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<App />);
