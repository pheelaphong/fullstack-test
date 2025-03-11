// resources/js/components/ProvinceProperties.jsx

import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

const ProvinceProperties = () => {
  const { province } = useParams();
  const [properties, setProperties] = useState([]);

  useEffect(() => {
    const fetchProperties = async () => {
      try {
        // ค้นหา properties โดยใช้ province เป็น search keyword
        const response = await axios.get('/api/properties', {
          params: { search: province },
        });
        if (response.data.data.length === 0) {
          // หากไม่พบข้อมูล ให้แสดง 404
          window.location.href = '/404';
        } else {
          setProperties(response.data.data);
        }
      } catch (error) {
        console.error('Error fetching province properties:', error);
      }
    };

    fetchProperties();
  }, [province]);

  return (
    <div>
      <h1>Properties in {province}</h1>
      <ul>
        {properties.map((property) => (
          <li key={property.id}>
            <h2>{property.title}</h2>
            <p>{property.description}</p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ProvinceProperties;
