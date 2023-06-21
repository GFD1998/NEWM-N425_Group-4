import {useAuth} from "../../services/useAuth";
import {useEffect} from 'react'

const Signout = () => {
    const {logout} = useAuth();

    //need to wrap the setState call inside useEffect.
    useEffect(() => {
        logout();
    })

    return (
        <>
            <div className="main-heading">
                <div className="container">Authorization</div>
            </div>
            <div className="sub-heading">
                <div className="container">Sign Out</div>
            </div>
            <div className="main-content container">
                Thank you for your visit. You have signed out.
            </div>
        </>
    );
};

export default Signout;