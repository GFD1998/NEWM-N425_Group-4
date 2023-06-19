import {useState, createContext, useContext} from "react";
import {useLocation, useNavigate} from "react-router-dom";
import {settings} from "../config/config";

const AuthContext = createContext(null);
const AuthProvider = ({children}) => {
    const [isAuthed, setIsAuthed] = useState(false);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);
    const [user, setUser] = useState(null);
    let location = useLocation();
    let navigate = useNavigate();
    let from = location.state?.from?.pathname || "/signin";

    // User Login
    const login = (account) => {
        const url = settings.baseApiUrl + "/users/authJWT";
        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(account)
        })
            .then(response => {
                if (!response.ok) {
                    throw (response);
                }
                return response.json();
            })
            .then(
                (result) => {
                    setError(null);
                    setIsLoading(false);
                    setIsAuthed(true);
                    setUser({name: result.name, role: result.role, jwt: result.jwt});
                    navigate(from, {replace: true});
                })
            .catch(err => {
                setIsLoading(false);
                console.log(err);
                if (err.status == 401) {
                    setError("Incorrect username/password. Please try again.");
                } else {
                    setError("An error has occurred. Please try again.");
                }
            })
    };

    // User Logout
    const logout = () => {
        setIsAuthed(false);
        setUser(null);
    };


    // User Signup
    const signup = (account) => {
        const url = settings.baseApiUrl + "/users";
        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(account)
        })
            .then(response => {
                if (!response.ok) {
                    throw (response);
                }
                return response.json();
            })
            .then(
                (result) => {
                    setError(null);
                    setIsLoading(false);
                    //setIsAuthed(true);
                    setUser({name: result.data.name, role: result.data.role});
                })
            .catch(err => {
                setIsLoading(false);
                setError("An error has occurred. Please try again.");
            });
    }
    return (
        <AuthContext.Provider value = {{error, isLoading, isAuthed, user, login, logout, signup}}>
            {children}
        </AuthContext.Provider>
    )};
const useAuth = () => useContext(AuthContext);
export {AuthProvider, useAuth};