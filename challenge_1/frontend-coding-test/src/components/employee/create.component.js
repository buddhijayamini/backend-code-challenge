import React, { useEffect, useState } from 'react';
import { useNavigate } from "react-router-dom";
const CreateEmployee = () => {
  const [fname, setFName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const [address, setAddress] = useState("");
const navigate = useNavigate();


const addEmployee = async (fname, email,phone,address) => {
   await fetch('http://localhost:8000/api/v1/employee', {
      method: 'POST',
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
   addEmployee(fname,email,phone,address);
};    


return (
   <div className="app">
      <div className="add-post-container">
         <form onSubmit={handleSubmit}>
            <input type="text" className="form-control" value={fname} placeholder="Employee Name"
               onChange={(e) => setFName(e.target.value)}
            />
            <br/>
        
             <input type="text" className="form-control" value={email} placeholder="Email"
               onChange={(e) => setEmail(e.target.value)}
            />
            <br/>
            <input type="text" className="form-control" value={phone} placeholder="Telephone"
               onChange={(e) => setPhone(e.target.value)}
            />
            <br/>
            <input type="text" className="form-control" value={address} placeholder="Address"
               onChange={(e) => setAddress(e.target.value)}
            />
            <br/>
            <button type="submit" className='btn btn-primary' > Add Employee</button>
            
         </form>
      </div>
   </div>
);
};

export default CreateEmployee;