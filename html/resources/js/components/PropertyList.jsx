// resources/js/components/PropertyList.jsx

import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';

const PropertyList = () => {
  const [properties, setProperties] = useState([]);
  const [search, setSearch] = useState('');
  const [sort, setSort] = useState('');
  const [order, setOrder] = useState('asc');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);

  const fetchProperties = async () => {
    try {
      const response = await axios.get('/api/properties', {
        params: { search, sort, order, page },
      });
      setProperties(response.data.data);
      setTotalPages(response.data.last_page);
    } catch (error) {
      console.error('Error fetching properties:', error);
    }
  };

  useEffect(() => {
    fetchProperties();
  }, [search, sort, order, page]);

  return (
    <div>
      <h1>Properties</h1>
      <div>
        <input
          type="text"
          placeholder="Search by title or location"
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
        <select value={sort} onChange={(e) => setSort(e.target.value)}>
          <option value="">Sort By</option>
          <option value="price">Price</option>
          <option value="date">Date Listed</option>
        </select>
        <select value={order} onChange={(e) => setOrder(e.target.value)}>
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>

      <ul>
        {properties.map((property) => (
          <li key={property.id}>
            <h2>{property.title}</h2>
            <p>{property.description}</p>
            <p>Price: {property.price} {property.currency_symbol}</p>
            <p>Province: {property.geo.province}</p>
          </li>
        ))}
      </ul>

      <div>
        <button disabled={page <= 1} onClick={() => setPage(page - 1)}>
          Previous
        </button>
        <span> Page {page} of {totalPages} </span>
        <button disabled={page >= totalPages} onClick={() => setPage(page + 1)}>
          Next
        </button>
      </div>
    </div>
  );
};

export default PropertyList;
