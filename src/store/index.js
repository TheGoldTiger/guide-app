/*
Nová podoba vuexu, je lepší pro větší aplikace, kdy není vuex v jednom jediném souboru, ale je rozdělený do více a tak není potřeba v celém souboru vždy něco dohledávat. 
Také je to vhodnější pro lepší strukturu
*/

//Pro Vue 3 základní inicializace vuexu
import { createStore } from 'vuex'
//Import modulu vuexu pro stránku loginu
//Pokud bude v budoucnu více stránek, tak se přidávají stejným stylem
//pro každý modul je potřeba vytvořit složku s názvem modulu a v ní store.js s logikou
import game from './game/store'

//Nastavení, zda je aktuálně environment development, nebo production
const devMode = process.env.NODE_ENV === 'development';

//Všechny moduly, které se aktuálně ve vuexu používají. Pro přidání stačí oddělit čárkou a přidat další po importu
const modules = {
  game: game,
}

//Vyutvoření vuexu se všemi moduly. Po přidání modulu zde není potřeba nic měnit
export const store = createStore({
  modules
})


store.clearState = (clear = []) => {
  const newState = {}
  clear.forEach(name => {
    const defaultState = modules[name].defaultState
    if (defaultState) {
      newState[name] = defaultState()
    }
  })
  store.replaceState({ ...store.state, ...newState })
}

