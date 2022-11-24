import React, { useEffect, useState } from 'react';
import { useNavigate, useParams } from "react-router-dom";
const EditEmployee = () => {
  const [employee, setEmployee] = useState([]);
  const [fname, setFName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const [address, setAddress] = useState("");
const navigate = useNavigate();

useEffect(() => {
  const fetchEmployee = async () => {
    const id = uuidv4();
   console.log(id);
     const response = await fetch(
        'http://localhost:8000/api/v1/employee/'+id, {
          method: 'GET',
          headers: {
             'Content-type': 'application/json; charset=UTF-8',
        },}
     );
     const data = await response.json();
   // console.log(data.data.name);
     setEmployee(data.data);
  };
  fetchEmployee();
}, []);

const editEmployee = async (fname, email,phone,address) => {
   await fetch('http://localhost:8000/api/v1/employee', {
      method: 'PUT',
      body: JSON.stringify({
         name: fname,
         email: email,
         tel: phone,
         address:address,
      }),
      headers: {
         'Content-type': 'application/json; charset=UTF-8',
         },
   })
      .then((response) => response.json())
      .then((data) => {    
         setFName('');
         setEmail('');
         setPhone('');
         setAddress("");
         navigate("/employee");
      })
      .catch((err) => {
         console.log(err.message);
      });
};

const handleSubmit = (e) => {
   e.preventDefault();
   editEmployee(fname,email,phone,address);
};    


return (
   <div className="app">
      <div className="add-post-container">
         <form onSubmit={handleSubmit}>
         
            <input type="text" className="form-control" value={employee.name} placeholder="Employee Name"
               onChange={(e) => setFName(e.target.value)} readOnly
            />
            <br/>
        
             <input type="text" className="form-control" value={employee.email} placeholder="Email"
               onChange={(e) => setEmail(e.target.value)}
            />
            <br/>
            <input type="text" className="form-control" value={employee.tel} placeholder="Telephone"
               onChange={(e) => setPhone(e.target.value)}
            />
            <br/>
            <input type="text" className="form-control" value={employee.address} placeholder="Address"
               onChange={(e) => setAddress(e.target.value)}
            />
            <br/>
            <button type="submit" className='btn btn-primary' > Add Employee</button>
            
         </form>
      </div>
   </div>
);
};

export default EditEmployee;