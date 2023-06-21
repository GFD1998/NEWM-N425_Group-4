import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Layout from "../components/Layout";
import Home from "../pages/home";
import NoMatch from "../pages/nomatch";
import MenuItem from "../pages/menuitem/menuitem";
import MenuItems from "../pages/menuitem/menuitems";
import Allergen from "../pages/allergen/allergen";
import Ingredient from "../pages/ingredient/ingredient";
import Ingredients from "../pages/ingredient/ingredients";
import NutritionalInformation from "../pages/nutritionalInformation/nutritionalinformation";
import {AuthProvider} from "../services/useAuth";
import RequireAuth from "../components/RequireAuth";
import Signin from "../pages/auth/signin";
import Signout from "../pages/auth/signout";
import Signup from "../pages/auth/signup";

const AppRoutes = () => {
    return (
        <Router>
            <AuthProvider>
                <Routes>
                    <Route path="/" element={<Layout />}>
                        <Route index element={<Home/>}/>
                        <Route path="menuitems" element={
                            <RequireAuth>
                                <MenuItems/>
                            </RequireAuth>
                        }>
                            {/* <Route index element={<p>Select a professor to view details.</p>}/> */}
                            <Route path=":menuitemID" element={<MenuItem/>}>
                                <Route path="ingredients" element={<Ingredients />}/>
                            </Route>
                        </Route>
                        <Route path="ingredients" element={
                            <RequireAuth>
                                <Ingredients/>
                            </RequireAuth>
                        }>
                            {/* <Route index element={<p>Select a professor to view details.</p>}/> */}
                            <Route path=":ingredientID" element={<Ingredient/>}>
                                <Route path="ingredients" element={<Ingredients />}/>
                            </Route>
                        </Route>
                        <Route path="allergen" element={
                            <RequireAuth>
                                <Allergen />
                            </RequireAuth>
                        }/>
                        <Route path="ingredients" element={
                            <RequireAuth>
                                <Ingredients />
                            </RequireAuth>
                        }/>
                        <Route path="nutritionalinformation" element={
                            <RequireAuth>
                                <NutritionalInformation />
                            </RequireAuth>
                        }/>
                        <Route path="/signin" element={<Signin/>}/>
                        <Route path="/signout" element={<Signout/>}/>
                        <Route path="/signup" element={<Signup/>}/>
                        <Route path="*" element={<NoMatch/>}/>
                    </Route>
                </Routes>
            </AuthProvider>
        </Router>
    );
};

export default AppRoutes;
