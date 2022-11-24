import React, { useEffect, useState } from 'react';
import { useNavigate, useParams } from "react-router-dom";
const EditAttendance = () => {
  const [attendance, setAttendance] = useState([]);
  const [fname, setFName] = useState("");
  const [date1, setDate] = useState("");
  const [check_in, setCheckIn] = useState("");
  const [check_out, setCheckOut] = useState("");
const navigate = useNavigate();

useEffect(() => {
  const fetchAttendance = async () => {
   // const id = uuidv4();
   //console.log(id);
     const response = await fetch(
        'http://localhost:8000/api/v1/attendance/1', {
          method: 'GET',
          headers: {
             'Content-type': 'application/json; charset=UTF-8',
        },}
     );
     const data = await response.json();
   // console.log(data.data.employee.name);
     setAttendance(data.data);
  };
  fetchAttendance();
}, []);

const editAttendance = async (fname, date1,check_in,check_out) => {
   await fetch('http://localhost:8000/api/v1/attendance/1', {
      method: 'PUT',
      body: JSON.stringify({
         employee_id: 1,
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
         setFName('');
         setDate('');
         setCheckIn('');
         setCheckOut("");
         navigate("/attendance");
      })
      .catch((err) => {
         console.log(err.message);
      });
};

const handleSubmit = (e) => {
   e.preventDefault();
   editAttendance(fname,date1,check_in,check_out);
};    


return (
   <div className="app">
      <div className="add-post-container">
         <form onSubmit={handleSubmit}>
         
            <input type="text" className="form-control" value={attendance.id} placeholder="Employee Name"
               onChange={(e) => setFName(e.target.value)} readOnly
            />
            <br/>
        
             <input type="date" className="form-control" value={attendance.date} placeholder="Date"
               onChange={(e) => setDate(e.target.value)}
            />
            <br/>
            <input type="time" className="form-control" value={attendance.check_in} placeholder="Check In"
               onChange={(e) => setCheckIn(e.target.value)}
            />
            <br/>
            <input type="time" className="form-control" value={attendance.check_out} placeholder="Check Out"
               onChange={(e) => setCheckOut(e.target.value)}
            />
            <br/>
            <button type="submit" className='btn btn-primary' > Update Attendance</button>
            
         </form>
      </div>
   </div>
);
};

export default EditAttendance;