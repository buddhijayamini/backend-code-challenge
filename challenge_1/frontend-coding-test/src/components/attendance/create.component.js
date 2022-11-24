import React, { useEffect, useState } from 'react';
import { useNavigate } from "react-router-dom";
const CreateAttendance = () => {
  const [employee, setEmployee] = useState([]);
  const [selectedEmployee, setSelectedEmployee] = useState("");
  const [date1, setDate] = useState("");
  const [check_in, setCheckIn] = useState("");
  const [check_out, setCheckOut] = useState("");
const navigate = useNavigate();

useEffect(() => {
   const fetchEmployee = async () => {
     const response = await fetch("http://localhost:8000/api/v1/employee", {
       method: "GET",
       headers: {
         "Content-type": "application/json; charset=UTF-8",
         },
     });
     const data = await response.json();
     //console.log(data);
     setEmployee(data.data);
   };
  fetchEmployee();
 }, []);
 
 function handleSelect(e) {
   const empSel = e.target.value;
   setSelectedEmployee(empSel);
 }


const addAttendance = async (date1, check_in,check_out) => {
   await fetch('http://localhost:8000/api/v1/attendance', {
      method: 'POST',
      body: JSON.stringify({
         employee_id : selectedEmployee,
         date: date1,
         check_in: check_in,
         check_out:check_out,
      }),
      headers: {
         'Content-type': 'application/json; charset=UTF-8',
         },
   })
      .then((response) => response.json())
      .then((data) => {   
         setEmployee(''); 
         setDate('');
         setCheckIn('');
         setCheckOut('');
         navigate("/employee");
      })
      .catch((err) => {
         console.log(err.message);
      });
};

const handleSubmit = (e) => {
   e.preventDefault();
   addAttendance(date1,check_in,check_out);
};    


return (
   <div className="app">
      <div className="add-post-container">
         <form onSubmit={handleSubmit}>
         <select className="form-control" value={selectedEmployee} onChange={(e) => handleSelect(e)} required>                 
                          {employee.length > 0 && employee.map((row) => (
                              <option key={row.id} value={row.id}>{row.name}</option>
                            ))}
                        </select>
            <br/>
           
             <input type="date" className="form-control" value={date1} placeholder="date"
               min="2018-01-01" max="2025-12-31"   onChange={(e) => setEmail(e.target.value)}
            />
            <br/>
            <input type="time" className="form-control" value={check_in} placeholder="Check IN"
               onChange={(e) => setPhone(e.target.value)}
            />
            <br/>
            <input type="time" min="09:00" max="18:00" className="form-control" value={check_out} placeholder="Check OUT"
               onChange={(e) => setPhone(e.target.value)}
            />
            <br/>
            <button type="submit" className='btn btn-primary' > Add Attendance</button>
            
         </form>
      </div>
   </div>
);
};

export default CreateAttendance;