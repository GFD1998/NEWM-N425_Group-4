import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Layout from "../components/Layout";
import Home from "../pages/home";
import NoMatch from "../pages/nomatch";
import MenuItem from "../pages/menuitem/menuitem";
import MenuItems from "../pages/menuitem/menuitems";
import CreateMenuItem from "../pages/menuitem/createMenuItem";
import UpdateMenuItem from "../pages/menuitem/updateMenuItem";
import DeleteMenuItem from "../pages/menuitem/deleteMenuItem";
import Allergen from "../pages/allergen/allergen";
import Allergens from "../pages/allergen/allergens";
import Ingredient from "../pages/ingredient/ingredient";
import Ingredients from "../pages/ingredient/ingredients";
import NutritionalInformation from "../pages/nutritionalInformation/nutritionalinformation";
import NutritionalInformations from "../pages/nutritionalInformation/nutritionalinformations";

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
                            <Route path=":menuitemID" element={<MenuItem/>}>
                                <Route path="update" element={<CreateMenuItem/>}>
                                </Route>
                                <Route path="delete" element={<CreateMenuItem/>}>
                                </Route>
                            </Route>
                            <Route path="create" element={<CreateMenuItem/>}>
                            </Route>
                        </Route>

                        <Route path="ingredients" element={
                            <RequireAuth>
                                <Ingredients/>
                            </RequireAuth>
                        }>
                            <Route path=":ingredientID" element={<Ingredient/>}>
                            </Route>
                        </Route>

                        <Route path="allergens" element={
                            <RequireAuth>
                                <Allergens/>
                            </RequireAuth>
                        }>
                            <Route path=":allergenID" element={<Allergen/>}>
                            </Route>
                        </Route>

                        <Route path="nutritionalinformations" element={
                            <RequireAuth>
                                <NutritionalInformations/>
                            </RequireAuth>
                        }>
                            <Route path=":nutritionalinformationID" element={<NutritionalInformation/>}>
                            </Route>
                        </Route>
                        
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
